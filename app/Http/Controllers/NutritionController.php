<?php

namespace App\Http\Controllers;

use App\Services\NutritionService;
use Illuminate\Support\Facades\Http;

class NutritionController extends Controller
{
    protected $nutritionService;

    public function __construct(NutritionService $nutritionService) {
        $this->nutritionService = $nutritionService;
    }
    public function submitIngredients() {
        $ingredients = [
            [
                "name"=> "milk",
                "carbs" => 0.6,
                "fat" => 7.8,
                "protein" => 7.1,
            ],
            [
                "name" => "beans",
                "carbs" => 35,
                "fat" => 3.8,
                "protein" => 10.7,
            ]
        ];
        
        foreach ($ingredients as $ingredient) {
            $response = $this->nutritionService->postIngredient($ingredient);
            
            if (!$response->successful()) {
                return response()->json(['error' => "Failed to submit an ingredient",
                                               'details' => $response->body()]
                , $response->status());
            }
        }

        return response()->json(['success' => "Ingredients were added successfully!"], 201);
    }
}
