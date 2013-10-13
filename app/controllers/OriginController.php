<?php
class OriginController extends BaseController
{
    /**
     * Index
     * @return Origin
     */
    public function index()
    {
        return Origin::all();
    }

    /**
     * Show
     * @param  Origin    $origin
     * @return Origin
     */
    public function show(Origin $origin)
    {
        return $origin;
    }
}