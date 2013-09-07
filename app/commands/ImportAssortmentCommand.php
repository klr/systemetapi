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
        ini_set('memory_limit', '256M');

        if (App::environment() == 'development') {
            $xml = simplexml_load_file('Alla+Artiklar.xml');
        } else {
            $xml = simplexml_load_file('http://www.systembolaget.se/Assortment.aspx?Format=Xml');
        }

        $numProducts = 0;

        foreach ($xml->artikel as $row) {
            $numProducts++;

            $data = [
                'product_number'  => $row->nr,
                'article_id'      => $row->Artikelid,
                'name'            => $row->Namn,
                'name_2'          => $row->Namn2,
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
                foreach ($data as $key => $val) {
                    $exists->$key = $val;
                }

                $exists->save();
                continue;
            }

            $product = Product::create($data);
            $tags = Tag::mapping((string) $row->Varugrupp);

            if (!empty($tags)) {
                $product->tag($tags);
            }

            // Clean up
            unset($product, $tags, $data);
        }

        $this->info('Imported ' . $numProducts . ' products');
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            //array('example', InputArgument::REQUIRED, 'An example argument.'),
        );
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
            //array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
        );
    }

}