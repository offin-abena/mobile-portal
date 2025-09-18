<?php
namespace App\Traits;
trait LogsHttpErrors
{
    /**
     * Log an HTTP error response.
     *
     * @param string   $errorMessage
     * @param Response $response
     * @return void
     */
    protected function logHttpError(string $errorMessage, $response): void
    {
        \Log::error("{$errorMessage} {$response->status()} for {$response->effectiveUri()}: {$response->body()}");
    }
}
