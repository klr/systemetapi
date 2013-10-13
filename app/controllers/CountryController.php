<?php
class CountryController extends BaseController
{
    /**
     * Index
     * @return Country
     */
    public function index()
    {
        return Country::all();
    }

    /**
     * Show
     * @param  Country    $country
     * @return Country
     */
    public function show(Country $country)
    {
        return $country;
    }
}