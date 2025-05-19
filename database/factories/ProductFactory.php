<?php
declare(strict_types=1);

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Связанная модель фабрики.
     *
     * @var class-string<Product>
     */
    protected $model = Product::class;

    /**
     * Генерация фейковых данных для товара.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'     => 'Товар ' . $this->faker->word(),
            'price'    => $this->faker->randomFloat(2, 100, 1000),
            'quantity' => $this->faker->numberBetween(1, 100),
        ];
    }
}
