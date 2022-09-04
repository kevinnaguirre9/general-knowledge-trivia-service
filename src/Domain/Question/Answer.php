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
     * @var string
     */
    protected $primaryKey = 'uuid';

    /**
     * @var bool
     */
    public $timestamps = false;

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
    ];

    /**
     * @return bool
     */
    public function isCorrectAnswer(): bool
    {
        return $this->is_correct;
    }
}
