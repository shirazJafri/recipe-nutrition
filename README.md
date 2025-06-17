# Nutrition Recipe API (Laravel)

A RESTful API built with Laravel to manage recipes, ingredients, and cooking steps while integrating a Nutrition API to calculate nutritional values.

## ⚙️ Installation

1. **Clone the repository:**

```bash
git clone https://github.com/your-username/laravel-nutrition-api.git
cd laravel-nutrition-api
```

2. **Install dependencies:**

```bash
composer install
```

3. **Configure `.env`:**
Update external API credentials in the `.env` file:

```bash
NUTRITION_API_URL=https://api.example.com
NUTRITION_API_USERNAME=your_username
NUTRITION_API_PASSWORD=your_password
```

4. **Run migrations:**

```bash
php artisan migrate:fresh.
```

5. **Run the application:**

```bash
composer run dev
```

6. **Testing if things works as expected:**

One can utilize the `cURL_examples.sh` file in the project directory
post server-startup to interact with the application and perform the
relevant CRUD operations.
