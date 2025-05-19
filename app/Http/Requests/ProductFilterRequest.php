<?php
declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Валидирует входящие GET-запросы на фильтрацию товаров.
 *
 * Ожидает параметр:
 * - properties: ассоциативный массив вида properties[НазваниеОпции][]=Значение
 *
 * Пример:
 * /api/products?properties[Цвет][]=Белый&properties[Бренд][]=IKEA
 */
class ProductFilterRequest extends FormRequest
{
    /**
     * Разрешено ли выполнять этот запрос.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Правила валидации запроса.
     *
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [
            'properties' => 'sometimes|array',
            'properties.*' => 'array',
            'properties.*.*' => 'string',
        ];
    }

    /**
     * Сообщения об ошибках валидации.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'properties.array' => 'Поле properties должно быть массивом.',
            'properties.*.array' => 'Каждое свойство должно быть массивом значений.',
            'properties.*.*.string' => 'Каждое значение свойства должно быть строкой.',
        ];
    }
}
