<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\ProductFilterRequest;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;

/**
 * @group Каталог товаров
 *
 * Управление каталогом: список товаров, фильтрация.
 */
class ProductController extends Controller
{
    /**
     * @var ProductService Сервис фильтрации и получения товаров
     */
    private readonly ProductService $productService;

    /**
     * Конструктор контроллера товаров.
     *
     * @param ProductService $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Получение списка товаров с фильтрацией по опциям.
     *
     * Пример запроса:
     * GET /api/products?properties[Цвет][]=Белый&properties[Бренд][]=IKEA
     *
     * @param ProductFilterRequest $request
     * @return JsonResponse
     */
    public function index(ProductFilterRequest $request): JsonResponse
    {
        try {
            $filters = $request->validated()['properties'] ?? [];
            $products = $this->productService->getFilteredProducts($filters);

            return $this->successResponse($products, 'Список товаров');
        } catch (\Throwable $e) {
            report($e);

            return $this->errorResponse(
                'Ошибка при получении списка товаров',
                config('app.debug') ? $e->getMessage() : null,
                500
            );
        }
    }
}
