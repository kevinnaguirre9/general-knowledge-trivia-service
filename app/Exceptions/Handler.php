<?php

namespace App\Exceptions;

use GeneralKnowledgeTrivia\Domain\Auth\Exceptions\InvalidAuthCredentials;
use GeneralKnowledgeTrivia\Domain\Auth\Exceptions\InvalidToken;
use GeneralKnowledgeTrivia\Domain\Category\Exceptions\CategoryNotFound;
use GeneralKnowledgeTrivia\Domain\Common\Exceptions\InvalidUuid;
use GeneralKnowledgeTrivia\Domain\Question\Exceptions\QuestionNotFound;
use GeneralKnowledgeTrivia\Domain\User\Exceptions\InvalidEmail;
use GeneralKnowledgeTrivia\Domain\User\Exceptions\InvalidPassword;
use GeneralKnowledgeTrivia\Domain\User\Exceptions\UserAlreadyRegistered;
use GeneralKnowledgeTrivia\Domain\User\Exceptions\UserNotFound;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

/**
 * Class Handler
 *
 * @package App\Exceptions
 */
class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * A list of the BAD REQUEST exceptions.
     *
     * @var array
     */
    protected array $badRequestExceptions = [
        InvalidUuid::class,
        InvalidEmail::class,
        InvalidPassword::class,
        UserAlreadyRegistered::class,
    ];

    /**
     * A list of the NOT FOUND exceptions.
     *
     * @var array
     */
    protected array $notFoundExceptions = [
        UserNotFound::class,
        CategoryNotFound::class,
        QuestionNotFound::class,
    ];

    /**
     * @var string[]
     */
    protected array $unauthorizedExceptions = [
        InvalidAuthCredentials::class,
        InvalidToken::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        if (env('APP_DEBUG'))
            return parent::render($request, $exception);

        $status = Response::HTTP_INTERNAL_SERVER_ERROR;

        if ($exception instanceof MethodNotAllowedHttpException)
        {
            $status = Response::HTTP_METHOD_NOT_ALLOWED;
            $exception = new MethodNotAllowedHttpException([], 'HTTP_METHOD_NOT_ALLOWED', $exception);
        }
        else if ($this->isNotFoundException($exception))
        {
            $status = Response::HTTP_NOT_FOUND;
            $exception = new NotFoundHttpException($exception->getMessage() ?? 'HTTP_NOT_FOUND', $exception);
        }
        else if ($this->isBadRequestException($exception))
        {
            $status = Response::HTTP_BAD_REQUEST;
            $exception = new HttpException($status, $exception->getMessage() ?? 'HTTP_BAD_REQUEST', $exception);
        }
        else if ($this->isUnauthorizedException($exception))
        {
            $status = Response::HTTP_UNAUTHORIZED;
            $exception = new HttpException($status, $exception->getMessage() ?? 'HTTP_UNAUTHORIZED', $exception);
        }
        else if ($exception instanceof ValidationException)
        {
            $status = Response::HTTP_UNPROCESSABLE_ENTITY;
            $exception = new HttpException($status, $exception->getResponse()->getContent());
        }
        else if ($exception)
        {
            $exception = new HttpException($status, $exception->getMessage());
        }

        $message = $exception->getMessage();

        return response()->json([
            'error' => [
                'message' => json_decode($message) ?? $message,
                'status' => $status,
            ],
        ], $status);
    }


    /**
     * @param Throwable $exception
     * @return bool
     */
    private function isNotFoundException(Throwable $exception) : bool
    {
        return collect($this->notFoundExceptions)
            ->contains($this->validateInstanceOf($exception));
    }

    /**
     * @param Throwable $exception
     * @return bool
     */
    private function isBadRequestException(Throwable $exception): bool
    {
        return collect($this->badRequestExceptions)
            ->contains($this->validateInstanceOf($exception));
    }

    /**
     * @param Throwable $exception
     * @return bool
     */
    private function isUnauthorizedException(Throwable $exception): bool
    {
        return collect($this->unauthorizedExceptions)
            ->contains($this->validateInstanceOf($exception));
    }

    /**
     * @param Throwable $exception
     * @return \Closure
     */
    protected function validateInstanceOf(Throwable $exception): \Closure
    {
        return function ($exceptionClass) use ($exception) {
            return $exception instanceof $exceptionClass;
        };
    }
}
