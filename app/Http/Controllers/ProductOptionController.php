<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\ProductOptionService;
use Illuminate\Http\JsonResponse;
use Throwable;

/**
 * @group Опции товаров
 *
 * Получение доступных фильтров (опций) и их значений.
 */
class ProductOptionController extends Controller
{
    /**
     * @var ProductOptionService Сервис опций товаров
     */
    private readonly ProductOptionService $optionService;

    /**
     * Конструктор контроллера опций товаров.
     *
     * @param ProductOptionService $optionService
     */
    public function __construct(ProductOptionService $optionService)
    {
        $this->optionService = $optionService;
    }

    /**
     * Получение всех доступных опций и значений.
     *
     * Пример ответа:
     * {
     *   "Цвет": ["Белый", "Чёрный", "Синий"],
     *   "Бренд": ["IKEA", "Philips", "Xiaomi"]
     * }
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        try {
            $options = $this->optionService->getAvailableOptions();

            return $this->successResponse($options, 'Список доступных опций');
        } catch (Throwable $e) {
            report($e);

            return $this->errorResponse(
                'Ошибка при получении списка опций',
                config('app.debug') ? $e->getMessage() : null,
                500
            );
        }
    }
}
