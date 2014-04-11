<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ImportAssortmentCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'assortment:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports assortment from Systembolaget.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        ini_set('memory_limit', '512M');

        $this->info('Loading XML...');

        if (App::environment() == 'development') {
            $xml = simplexml_load_file('Alla+Artiklar.xml');
        } else {
            $xml = simplexml_load_file('http://www.systembolaget.se/Assortment.aspx?Format=Xml');
        }

        $this->info('XML loaded');

        $numProducts = 0;

        foreach ($xml->artikel as $row) {
            $numProducts++;

            $data = [
                'product_number'  => $row->nr,
                'article_id'      => $row->Artikelid,
                'name'            => $row->Namn,
                'name_2'          => $row->Namn2,
                'start_date'      => $row->Saljstart,
                'volume'          => $row->Volymiml / 1000,
                'price'           => $row->Prisinklmoms,
                'price_per_liter' => $row->PrisPerLiter,
                'alcohol'         => substr($row->Alkoholhalt, 0, -1) / 100,
                'year'            => !empty($row->Argang) ? $row->Argang : 0,
                'ecological'      => $row->Ekologisk,
                'koscher'         => $row->Koscher
            ];
            $data['apk'] = Product::calculateApk($data['alcohol'], $data['price_per_liter']);

            $exists = Product::where('product_number', $row->nr)->first();

            if (!empty($exists)) {
                $product = $exists;

                foreach ($data as $key => $val) {
                    $exists->$key = $val;
                }

                $exists->save();
            } else {
                $product = Product::create($data);
                $tags = Tag::mapping((string) $row->Varugrupp);

                if (!empty($tags)) {
                    $product->tag($tags);
                }
            }

            $this->mapCountry($product, $row->Ursprunglandnamn);
            $this->mapOrigin($product, $row->Ursprung);

            // Clean up
            unset($product, $tags, $data);
        }

        $this->info('Imported ' . $numProducts . ' products');
    }

    /**
     * Map country
     * @param  Product $product
     * @param  string  $countryName
     * @return void
     */
    private function mapCountry(Product $product, $countryName)
    {
        $countryName = trim($countryName);

        if (empty($countryName)) {
            return;
        }

        $country = Country::where('name', $countryName)->first();

        if (empty($country)) {
            $country = Country::create([
                'name' => $countryName
            ]);
        }

        $product->country_id = $country->id;
        $product->save();
    }

    /**
     * Map origin
     * @param  Product $product
     * @param  string  $originName
     * @return void
     */
    private function mapOrigin(Product $product, $originName)
    {
        $originName = trim($originName);

        if (empty($originName)) {
            return;
        }

        $origin = Origin::where('name', $originName)->first();

        if (empty($country)) {
            $origin = Origin::create([
                'name' => $originName
            ]);
        }

        $product->origin_id = $origin->id;
        $product->save();
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [];
    }

}