<?php

namespace App\Traits;


use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    /**
     * Return a success JSON response.
     *
     * @param mixed  $data       Data to be returned.
     * @param string $message    Optional message.
     * @param int    $statusCode HTTP status code (default 200).
     * @return JsonResponse
     */
    protected function success(mixed $data = null, string $message = '', int $statusCode = 200): JsonResponse
    {
        $response = [
            'status'  => 'success',
            'message' => $message,
            'data'    => $data,
        ];

        return response()->json($response, $statusCode);
    }

    /**
     * Return an error JSON response.
     *
     * @param mixed  $data       Data to be returned (e.g., error details).
     * @param string $message    Error message.
     * @param int    $statusCode HTTP status code (default 422).
     * @return JsonResponse
     */
    protected function error(mixed $data = null, string $message = '', int $statusCode = 422): JsonResponse
    {
        $response = [
            'status'  => 'error',
            'message' => $message,
            'data'    => $data,
        ];

        return response()->json($response, $statusCode);
    }

    /**
     * Return a not found JSON response.
     *
     * @param string $message    Not found message.
     * @param mixed  $data       Optional data.
     * @param int    $statusCode HTTP status code (default 404).
     * @return JsonResponse
     */
    protected function notFound(string $message = 'Not Found', mixed $data = null, int $statusCode = 404): JsonResponse
    {
        $response = [
            'status'  => 'error',
            'message' => $message,
            'data'    => $data,
        ];

        return response()->json($response, $statusCode);
    }

    /**
     * Return an unauthorized JSON response.
     *
     * @param string $message    Unauthorized message.
     * @param mixed  $data       Optional data.
     * @param int    $statusCode HTTP status code (default 401).
     * @return JsonResponse
     */
    protected function unauthorized(string $message = 'Unauthorized', mixed $data = null, int $statusCode = 401): JsonResponse
    {
        $response = [
            'status'  => 'error',
            'message' => $message,
            'data'    => $data,
        ];

        return response()->json($response, $statusCode);
    }
}