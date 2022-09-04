<?php

namespace GeneralKnowledgeTrivia\Domain\User;

use GeneralKnowledgeTrivia\Domain\Game\Game;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Jenssegers\Mongodb\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

/**
 * Class User
 *
 * @package GeneralKnowledgeTrivia\Domain\User
 */
class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasFactory;

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
        'first_name',
        'surname',
        'country',
        'email',
        'password',
        'token',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [
        '_id',
        'token',
        'password',
        'created_at',
        'updated_at',
    ];

    /**
     * @param $abilities
     * @param $arguments
     * @return void
     */
    public function can($abilities, $arguments = [])
    {
        // TODO: Implement can() method.
    }

    /**
     * @return HasMany
     */
    public function games(): HasMany
    {
        return $this->hasMany(Game::class);
    }
}
