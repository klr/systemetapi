<?php
class Origin extends Eloquent
{
    /**
     * Table
     * @var string
     */
    protected $table = 'origin';

    /**
     * Guarded
     * @var array
     */
    protected $guarded = [];

    /**
     * Hidden
     * @var array
     */
    protected $hidden = ['updated_at', 'created_at'];
}