<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class NutritionService
{
    protected $url;
    protected $username;
    protected $password;

    public function __construct()
    {
        $this->url = config('services.nutrition.url');
        $this->username = config('services.nutrition.username');
        $this->password = config('services.nutrition.password');
    }

    public function getIngredient(string $ingredientName)
    {
        $response = Http::withBasicAuth($this->username, $this->password)
            ->get($this->url, ['ingredient' => $ingredientName]);

        if ($response->getStatusCode() == 404) {
            return null;
        }

        return $response->json();
    }

    public function postIngredient(array $ingredientData)
    {
        return Http::asForm()  # Content Type x-www-form-urlencoded
            ->withBasicAuth($this->username, $this->password)
            ->post($this->url, $ingredientData);
    }

}
