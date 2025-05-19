<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

/**
 * Базовый контроллер приложения.
 *
 * Содержит общие методы для унифицированных JSON-ответов.
 */
abstract class Controller
{
    /**
     * Успешный ответ в формате JSON.
     *
     * @param mixed       $data    Данные ответа (массив, объект, коллекция)
     * @param string      $message Сообщение об успешной операции
     * @param int         $code    HTTP-код ответа (по умолчанию 200)
     * @return JsonResponse
     */
    protected function successResponse(mixed $data = null, string $message = 'OK', int $code = 200): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data'    => $data,
            'errors'  => null,
            'code'    => $code,
        ], $code);
    }

    /**
     * Ошибочный ответ в формате JSON.
     *
     * @param string      $message Сообщение об ошибке
     * @param mixed|null  $errors  Детали ошибки (массив, строка, null)
     * @param int         $code    HTTP-код ошибки (по умолчанию 400)
     * @return JsonResponse
     */
    protected function errorResponse(string $message = 'Ошибка', mixed $errors = null, int $code = 400): JsonResponse
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'data'    => null,
            'errors'  => $errors,
            'code'    => $code,
        ], $code);
    }
}
