<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NutritionController extends Controller
{
    public function submitIngredients() {

        $url = config("services.nutrition.url");
        $username = config("services.nutrition.username");
        $password = config("services.nutrition.password");

        $ingredients = [
            [
                "name"=> "gouda",
                "carbs" => 0.6,
                "fat" => 7.8,
                "protein" => 7.1,
            ],
            [
                "name" => "chickpeas",
                "carbs" => 35,
                "fat" => 3.8,
                "protein" => 10.7,
            ]
        ];
        
        foreach ($ingredients as $ingredient) {
            $response = Http::asForm() # Content Type x-www-form-urlencoded
                        ->withBasicAuth($username, $password)
                        ->post($url, $ingredient);
            
            if (!$response->successful()) {
                return response()->json(['error' => "Failed to submit an ingredient",
                                               'details' => $response->body()]
                , $response->status());
            }
        }

        return response()->json(['success' => "Ingredients were added successfully!"], 201);
    }
}
