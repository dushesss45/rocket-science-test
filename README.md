
# 🚀 Rocket Science — Каталог товаров (Laravel REST API)

Это тестовый проект для компании **Rocket Science**, реализующий каталог товаров с фильтрацией по произвольным опциям.  

---

## 🔧 Технологии

- PHP 8.2
- Laravel 10
- PostgreSQL
- Docker + Docker Compose
- OpenAPI (ручная спецификация)
- SOLID-архитектура, сервисный слой, Form Request
- Faker + сидеры

---

## 📦 Установка и запуск

```bash
git clone https://github.com/dushesss45/rocket-science-test.git
cd rocket-science-test

cp .env.example .env

docker compose up -d --build

docker compose exec app composer install

docker compose exec app php artisan migrate:fresh --seed
```

Проект будет доступен по адресу:
📍 `http://localhost:8088`

---

## 🔌 API Маршруты

### `GET /api/products`

Список товаров с фильтрацией по опциям.

**Пример запроса:**

```
/api/products?properties[Цвет][]=Белый&properties[Бренд][]=IKEA
```

**Пример ответа (сокращённый):**

```json
{
  "success": true,
  "message": "Список товаров",
  "data": {
    "current_page": 1,
    "data": [
      {
        "id": 209,
        "name": "Товар totam",
        "price": "163.80",
        "quantity": 44,
        "option_values": [
          { "option": { "name": "Цвет" }, "value": "Синий" },
          { "option": { "name": "Бренд" }, "value": "LG" }
        ]
      }
    ],
    ...
  },
  "code": 200
}
```

---

### `GET /api/options`

Список всех доступных опций для фильтрации и их значений:

**Пример ответа:**

```json
{
  "Цвет": ["Белый", "Чёрный", "Красный"],
  "Бренд": ["IKEA", "Philips", "LG"],
  ...
}
```

---

## 🧪 Пример CURL запроса

```bash
curl "http://localhost:8088/api/products?properties[Цвет][]=Белый&properties[Бренд][]=LG"
```

---

## 📘 OpenAPI спецификация

Файл `Каталог товаров — Rocket Science.postman_collection.json` находится в корне проекта.
Может быть импортирован в Postman.

---

## 📁 Структура проекта

```
app/
├── Http/
│   ├── Controllers/
│   ├── Requests/
├── Models/
├── Services/
database/
├── seeders/
├── factories/
```
