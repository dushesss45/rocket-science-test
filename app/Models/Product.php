<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * Модель "Товар".
 *
 * @property int $id
 * @property string $name
 * @property float $price
 * @property int $quantity
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @property-read ProductOptionValue[]|Collection $optionValues
 */
class Product extends Model
{
    use HasFactory;

    /**
     * Массово назначаемые поля.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'price', 'quantity'];

    /**
     * Опции (свойства) данного товара.
     *
     * @return HasMany
     */
    public function optionValues(): HasMany
    {
        return $this->hasMany(ProductOptionValue::class);
    }
}
