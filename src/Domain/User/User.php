<?php

namespace GeneralKnowledgeTrivia\Domain\User;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
        'password'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [
        '_id',
        'password',
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
}
