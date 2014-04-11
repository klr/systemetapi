<?php
class StoreController extends BaseController
{
    /**
     * Index
     * @return Tag
     */
    public function index()
    {
        // Create response
        $response = Response::json(
            Store::skip(Input::get('offset', 0))
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
     * @param  Store    $store
     * @return Store
     */
    public function show(Store $store)
    {
        return $store;
    }
}