<?php

namespace GeneralKnowledgeTrivia\Domain\Game;

use Illuminate\Support\Collection;
use Jenssegers\Mongodb\Eloquent\Model;

/**
 * Class Result
 *
 * @package GeneralKnowledgeTrivia\Domain\Game
 */
final class Result extends Model
{
    /**
     * @var string
     */
    protected $collection = 'results';

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
        'time_played',
        'right_answers',
        'wrong_answers',
        'success_rate',
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
     * @param Collection $attempts
     * @param float $timePlayed
     * @return $this
     */
    public static function fromAttempts(Collection $attempts, float $timePlayed): self
    {
        $totalQuestionsAnswered = $attempts->count();

        $totalRightAnswers = $attempts
            ->filter(fn(Attempt $Attempt) => $Attempt->isRightAnswer())
            ->count();

        $totalWrongAnswers = $totalQuestionsAnswered - $totalRightAnswers;

        $successRate = ($totalRightAnswers * 100) / $totalQuestionsAnswered;

        return new self([
            'time_played'   => $timePlayed,
            'right_answers' => $totalRightAnswers,
            'wrong_answers' => $totalWrongAnswers,
            'success_rate'  => $successRate,
        ]);
    }

}
