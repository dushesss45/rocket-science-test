<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\ProductOption;
use Illuminate\Support\Collection;

/**
 * Сервис для работы с опциями товаров.
 *
 * Отвечает за получение всех доступных опций и их возможных значений.
 */
class ProductOptionService
{
    /**
     * Получает список всех опций и их уникальных значений.
     *
     * @return Collection<string, Collection<string>>
     *
     * Пример:
     * [
     *   'Цвет' => ['Белый', 'Чёрный', 'Красный'],
     *   'Бренд' => ['IKEA', 'Philips']
     * ]
     */
    public function getAvailableOptions(): Collection
    {
        return ProductOption::with('values')
            ->get()
            ->groupBy('name')
            ->map(function ($items) {
                return $items->flatMap->values->pluck('value')->unique()->values();
            });
    }
}
