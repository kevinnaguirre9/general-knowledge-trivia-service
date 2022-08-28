<?php

namespace GeneralKnowledgeTrivia\Domain\Category;

use Jenssegers\Mongodb\Eloquent\Model;

/**
 * Class Category
 *
 * @package GeneralKnowledgeTrivia\Domain\Category
 */
final class Category extends Model
{
    /**
     * @var string
     */
    protected $collection = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'uuid',
        'name',
        'description'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [

    ];
}