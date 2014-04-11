<?php
use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ImportStoreCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'stores:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports stores.';

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
            $xml = simplexml_load_file('ButikerOmbud.xml');
        } else {
            $xml = simplexml_load_file('http://www.systembolaget.se/Assortment.aspx?butikerombud=1');
        }

        $this->info('XML loaded');

        foreach ($xml->ButikOmbud as $row) {
            $data = [
                'number'  => $row->Nr,
                'name'    => $row->Namn,
                'address' => trim($row->Address1 . ' ' . $row->Address2),
                'zip'     => str_replace(['S-', ' '], '', $row->Address3),
                'city'    => $row->Address4,
                'phone'   => $row->Telefon
            ];

            $existing = Store::where('number', $data['number'])->first();

            if ($existing) {
                $existing->update($data);
            } else {
                Store::create($data);
            }
        }

        $this->info('Done');
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