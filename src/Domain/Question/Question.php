<?php

namespace GeneralKnowledgeTrivia\Domain\Question;

use GeneralKnowledgeTrivia\Domain\Category\Category;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Relations\EmbedsMany;
use Jenssegers\Mongodb\Relations\BelongsTo;

/**
 * Class Question
 *
 * @package GeneralKnowledgeTrivia\Domain\Question
 */
final class Question extends Model
{
    /**
     * @var string
     */
    protected $collection = 'questions';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'uuid',
        'question',
        'category_id'
    ];

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return EmbedsMany
     */
    public function answers(): EmbedsMany
    {
        return $this->embedsMany(Answer::class);
    }
}
