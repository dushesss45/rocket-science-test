<?php
declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductOption;
use App\Models\ProductOptionValue;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Database\Seeder;

/**
 * Сидер для генерации тестовых товаров и их опций.
 *
 * Создаёт:
 * - 8 опций (Цвет, Бренд, Материал и т.д.)
 * - 500 товаров
 * - по 8 опций у каждого товара
 */
class ProductSeeder extends Seeder
{
    /**
     * Запускает заполнение базы тестовыми товарами и опциями.
     *
     * @return void
     */
    public function run(): void
    {
        /** @var Generator $faker */
        $faker = Factory::create('ru_RU');

        $options = [
            'Цвет' => ['Белый', 'Чёрный', 'Синий', 'Красный', 'Зелёный', 'Жёлтый', 'Серый'],
            'Бренд' => ['IKEA', 'Philips', 'Xiaomi', 'Samsung', 'LG', 'Bosch'],
            'Материал' => ['Пластик', 'Металл', 'Дерево', 'Стекло', 'Керамика', 'Бетон'],
            'Тип' => ['Настольный', 'Подвесной', 'Напольный', 'Светильник-спот', 'Бра'],
            'Мощность (Вт)' => ['3', '5', '7', '9', '12', '15', '20'],
            'Цветовая температура' => ['2700K', '3000K', '4000K', '5000K', '6500K'],
            'Страна' => ['Китай', 'Россия', 'Германия', 'Польша', 'Италия', 'США'],
            'Гарантия (мес)' => ['6', '12', '18', '24', '36'],
        ];

        $optionModels = [];
        foreach ($options as $name => $values) {
            $optionModels[$name] = ProductOption::create(['name' => $name]);
        }

        Product::factory(500)->create()->each(function (Product $product) use ($faker, $optionModels, $options) {
            foreach ($optionModels as $optionName => $optionModel) {
                ProductOptionValue::create([
                    'product_id' => $product->id,
                    'option_id'  => $optionModel->id,
                    'value'      => $faker->randomElement($options[$optionName]),
                ]);
            }
        });
    }
}
