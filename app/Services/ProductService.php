<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\Product;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * Сервис для работы с товарами.
 *
 * Обрабатывает бизнес-логику фильтрации каталога по произвольным опциям.
 */
class ProductService
{
    /**
     * Получает список товаров с учётом фильтрации по опциям.
     *
     * @param array<string, array<int, string>> $filters
     *     Массив фильтров, где ключ — название опции, а значение — массив значений.
     *
     *     Пример:
     *     [
     *       'Цвет' => ['Белый', 'Чёрный'],
     *       'Бренд' => ['IKEA']
     *     ]
     *
     * @return LengthAwarePaginator
     */
    public function getFilteredProducts(array $filters = []): LengthAwarePaginator
    {
        $query = Product::with('optionValues.option');

        if (!empty($filters)) {
            foreach ($filters as $optionName => $values) {
                $query->whereHas('optionValues', function ($q) use ($optionName, $values) {
                    $q->whereHas('option', fn($optQ) => $optQ->where('name', $optionName))
                        ->whereIn('value', $values);
                });
            }
        }

        return $query->paginate(40);
    }
}
