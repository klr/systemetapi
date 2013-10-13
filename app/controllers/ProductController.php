<?php
class ProductController extends BaseController
{
    /**
     * Index
     * @return Product
     */
    public function index()
    {
        $product = new Product;
        $product = $product->withTrashed();

        // Name
        if ($name = Input::get('name')) {
            $product = $product->where('name', 'LIKE', '%' . $name . '%')
                ->whereOr('name_2', 'LIKE', '%' . $name . '%');
        }

        // Order by
        if ($orderBy = Input::get('order_by')) {
            $acceptedOrderBy = ['name', 'price', 'price_per_liter', 'alcohol', 'apk'];

            if (!in_array($orderBy, $acceptedOrderBy)) {
                throw new InvalidArgumentException('You can not sort by ' . $orderBy . '. Accepted values are: ' . implode(', ', $acceptedOrderBy));
            }
        }

        // Ecological
        if ($ecological = Input::get('ecological')) {
            $product = $product->where('ecological', (bool) $ecological);
        }

        // Koscher
        if ($koscher = Input::get('koscher')) {
            $product = $product->where('koscher', (bool) $koscher);
        }

        // Order by
        $product = $product->orderBy(Input::get('order_by', 'id'), Input::get('order', 'ASC'));

        // Price range
        $product = $product->where('price', '>', Input::get('price_from', 0))
            ->where('price', '<', Input::get('price_to', 99999));

        // Price per liter range
        $product = $product->where('price_per_liter', '>', Input::get('price_per_liter_from', 0))
            ->where('price_per_liter', '<', Input::get('price_per_liter_to', 99999));

        // Alcohol range
        $product = $product->where('alcohol', '>', Input::get('alcohol_from', 0))
            ->where('alcohol', '<', Input::get('alcohol_to', 1));

        // APK range
        $product = $product->where('apk', '>', Input::get('apk_from', 0))
            ->where('alcohol', '<', Input::get('apk_to', 99999));

        // Year range
        $product = $product->where('year', '>', Input::get('year_from', -1))
            ->where('year', '<', Input::get('year_to', 3000));

        // Tag
        if ($tags = Input::get('tag')) {
            $tags = explode(',', $tags);

            foreach ($tags as $key => $val) {
                $tags[$key] = (int) $val;
            }

            $productIds = [];
            $productTags = ProductTag::select('product_id')->whereIn('tag_id', $tags)->get();

            foreach ($productTags as $productTag) {
                $productIds[] = $productTag->product_id;
            }

            if (!empty($productIds)) {
                $product = $product->whereIn('id', $productIds);
            }
        }

        // Create response
        $response = Response::json($product
            ->with(['tags', 'country', 'origin'])
            ->skip(Input::get('offset', 0))
            ->take(Input::get('limit', 50))
            ->get());

        // JSONP
        if (Input::get('callback')) {
            $response->setCallback(Input::get('callback'));
        }

        return $response;
    }

    /**
     * Show
     * @param  Product $product
     * @return Product
     */
    public function show(Product $product)
    {
        return $product;
    }
}