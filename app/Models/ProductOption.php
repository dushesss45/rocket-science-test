<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * Модель "Опция товара" (например, Цвет, Бренд и т.д.).
 *
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read ProductOptionValue[]|Collection $values
 */
class ProductOption extends Model
{
    /**
     * Разрешённые для массового заполнения поля.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name'];

    /**
     * Значения этой опции для товаров.
     *
     * @return HasMany
     */
    public function values(): HasMany
    {
        return $this->hasMany(ProductOptionValue::class, 'option_id');
    }
}
