<?php

namespace GeneralKnowledgeTrivia\Domain\Game;

use GeneralKnowledgeTrivia\Domain\Question\Answer;
use GeneralKnowledgeTrivia\Domain\Question\Question;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Relations\BelongsTo;

/**
 * Class Attempt
 *
 * @package GeneralKnowledgeTrivia\Domain\Game
 */
final class Attempt extends Model
{
    /**
     * @var string
     */
    protected $collection = 'attempts';

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
        'question_id',
        'answer_id',
        'is_right_answer',
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
     * @return BelongsTo
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    /**
     * @return BelongsTo
     */
    public function answer(): BelongsTo
    {
        return $this->belongsTo(Answer::class);
    }

    /**
     * @return bool
     */
    public function isRightAnswer(): bool
    {
        return $this->is_right_answer;
    }
}
