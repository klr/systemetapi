<?php
class Country extends Eloquent
{
    /**
     * Table
     * @var string
     */
    protected $table = 'country';

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