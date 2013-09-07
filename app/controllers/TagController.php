<?php
class TagController extends BaseController
{
    /**
     * Index
     * @return Tag
     */
    public function index()
    {
        return Tag::all();
    }

    /**
     * Show
     * @param  Tag    $tag
     * @return Tag
     */
    public function show(Tag $tag)
    {
        return $tag;
    }
}