<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NutritionController;

Route::post('/nutrition/submit-ingredients', [NutritionController::class,'submitIngredients'])->name('nutrition.submit');
