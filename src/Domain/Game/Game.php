<?php

namespace GeneralKnowledgeTrivia\Domain\Game;

use GeneralKnowledgeTrivia\Domain\Category\Category;
use GeneralKnowledgeTrivia\Domain\User\User;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Relations\BelongsTo;
use Jenssegers\Mongodb\Relations\EmbedsMany;
use Jenssegers\Mongodb\Relations\EmbedsOne;

/**
 * Class Game
 *
 * @package GeneralKnowledgeTrivia\Domain\Game
 */
final class Game extends Model
{
    /**
     * @var string
     */
    protected $collection = 'games';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'uuid',
        'user_id',
        'category_id',
        'attempts',
        'result',
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
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

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
    public function attempts(): EmbedsMany
    {
        return $this->embedsMany(Attempt::class);
    }

    /**
     * @return EmbedsOne
     */
    public function result(): EmbedsOne
    {
        return $this->embedsOne(Result::class);
    }

}
