<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * class eloquent classic
 */
class ObjectTest extends Model 
{

    protected $table = "object_test";

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
