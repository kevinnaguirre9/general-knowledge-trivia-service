<?php

namespace GeneralKnowledgeTrivia\Domain\Category;

use GeneralKnowledgeTrivia\Domain\Question\Question;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Relations\HasMany;

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
     * @var string
     */
    protected $primaryKey = 'uuid';

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
        '_id',
        'created_at',
        'updated_at',
    ];

    /**
     * @return HasMany
     */
    public function questions(): HasMany
    {
        return $this->hasMany(Question::class, 'category_id');
    }

    public function getUuid(): string
    {
        return $this->uuid;
    }
}
