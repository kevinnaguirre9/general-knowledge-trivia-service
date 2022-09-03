<?php

namespace GeneralKnowledgeTrivia\Domain\Question;

use Jenssegers\Mongodb\Eloquent\Model;

/**
 * Class Answer
 *
 * @package GeneralKnowledgeTrivia\Domain\Question
 */
final class Answer extends Model
{
    /**
     * @var string
     */
    protected $collection = 'answers';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'uuid',
        'answer',
        'is_correct'
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
}
