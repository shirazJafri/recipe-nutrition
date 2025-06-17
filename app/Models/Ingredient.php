<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    protected $fillable = ['recipe_id', 'name', 'carbs', 'fat', 'protein'];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
