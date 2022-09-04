<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// Auth
$router->post('/auth/sign-up', [
    'as'    => 'auth.signUp',
    'uses'  => \App\Http\Controllers\V1\Auth\AuthSignUpPostController::class,
]);

$router->post('/auth/sign-in', [
    'as'    => 'auth.signIn',
    'uses'  => \App\Http\Controllers\V1\Auth\AuthSignInPostController::class,
]);

// Categories
$router->get('/categories', [
    'as'    => 'categories.getAll',
    'uses'  => \App\Http\Controllers\V1\Category\CategoryGetAllController::class,
]);

$router->get('/categories/{category}/games', [
    'as'    => 'categories.getGames',
    'uses'  => \App\Http\Controllers\V1\Game\GamesByCriteriaGetController::class,
]);


$router->group(['middleware' => 'auth'], function() use ($router) {

    // Categories
    $router->get('/categories/{category}/questions', [
        'as'    => 'categories.getQuestions',
        'uses'  => \App\Http\Controllers\V1\Question\QuestionGetController::class,
    ]);

    //Games
    $router->post('/games', [
        'as'    => 'categories.getQuestions',
        'uses'  => \App\Http\Controllers\V1\Game\GamePostController::class,
    ]);

    // Auth
    $router->delete('/auth/sign-out', [
        'as'    => 'auth.signOut',
        'uses'  => \App\Http\Controllers\V1\Auth\AuthSignOutDeleteController::class,
    ]);

});
