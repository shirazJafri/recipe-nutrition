<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\Step;
use App\Services\NutritionService;
use Brick\Math\Exception\IntegerOverflowException;
use Illuminate\Http\Request;

class RecipeController extends Controller
{

    protected $nutritionService;

    public function __construct(NutritionService $nutritionService)
    {
        $this->nutritionService = $nutritionService;
    }
    /**
     * Display a listing of the resource.
     * GET /api/recipes/
     */
    public function index()
    {
        $recipes = Recipe::with(['ingredients', 'steps'])->get();

        // Attach nutrition values to recipes.
        $recipes->transform(function ($recipe) {
            $recipe->nutrition = $this->nutritionService->calculateNutrition($recipe->ingredients->toArray());
            return $recipe;
        });

        return response()->json($recipes);
    }

    /**
     * Store a newly created resource in storage.
     * POST /api/recipes/
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'ingredients' => 'required|array|min:1',
            'ingredients.*.name' => 'required|string',
            'ingredients.*.carbs' => 'required|numeric',
            'ingredients.*.fat' => 'required|numeric',
            'ingredients.*.protein' => 'required|numeric',
            'steps' => 'required|array|min:1',
            'steps.*.step_number' => 'required|integer|min:1',
            'steps.*.description' => 'required|string',
        ]);

        $recipe = Recipe::create([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
        ]);

        foreach ($data['ingredients'] as $ingredientData) {
            $ingredientFromAPI = $this->nutritionService->getIngredient($ingredientData['name']);
            if (!$ingredientFromAPI) {
                $response = $this->nutritionService->postIngredient($ingredientData);
                if (!$response->successful()) {
                    return response()->json(["message" => "Failed to submit ingredient " . $ingredientData["name"] . ""], 400);
                }

                $ingredientUpdatedData = $ingredientData;
            } else {
                $ingredientUpdatedData = [
                    "name" => $ingredientData["name"],
                    "carbs" => $ingredientFromAPI["carbs"],
                    "fat" => $ingredientFromAPI["fat"],
                    "protein" => $ingredientFromAPI["protein"]
                ];
            }

            $ingredient = new Ingredient($ingredientUpdatedData);
            $recipe->ingredients()->save($ingredient);
        }

        foreach ($data['steps'] as $stepData) {
            $step = new Step($stepData);
            $recipe->steps()->save($step);
        }

        $recipe->load('ingredients', 'steps');

        $nutrition = $this->nutritionService->calculateNutrition($recipe->ingredients->toArray());

        return response()->json([
            'recipe' => $recipe,
            'nutrition' => $nutrition,
        ], 201);

    }

    /**
     * Display the specified resource.
     * GET /api/recipes/{id}
     */
    public function show($id)
    {
        $recipe = Recipe::with(['ingredients', 'steps'])->find($id);

        if (!$recipe) {
            return response()->json(['error' => 'Recipe not found'], 404);
        }

        $nutrition = $this->nutritionService->calculateNutrition($recipe->ingredients->toArray());

        return response()->json([
            'recipe' => $recipe,
            'nutrition' => $nutrition
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /api/recipes/{id}
     */
    public function destroy($id)
    {
        $recipe = Recipe::find($id);

        if ($recipe) {
            $recipe->delete();
        }

        return response()->json(['message' => 'Recipe deleted successfully!']);
    }
}
