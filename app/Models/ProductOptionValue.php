<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * Модель "Значение опции товара".
 *
 * Хранит конкретное значение опции (например, Цвет = Красный) для товара.
 *
 * @property int $id
 * @property int $product_id
 * @property int $option_id
 * @property string $value
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read Product $product
 * @property-read ProductOption $option
 */
class ProductOptionValue extends Model
{
    /**
     * Поля, разрешённые для массового заполнения.
     *
     * @var array<int, string>
     */
    protected $fillable = ['product_id', 'option_id', 'value'];

    /**
     * Товар, к которому относится это значение опции.
     *
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Опция, к которой относится это значение.
     *
     * @return BelongsTo
     */
    public function option(): BelongsTo
    {
        return $this->belongsTo(ProductOption::class, 'option_id');
    }
}
