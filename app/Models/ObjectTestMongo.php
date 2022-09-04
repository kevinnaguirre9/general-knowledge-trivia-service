<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;


/**
 * class eloquent mongodb Jenssegers
 */
class ObjectTestMongo extends Model 
{
    protected $collection = "object_test";

    protected $connection = 'mongodb';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'attribute_test'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [
    ];
}
