<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = ['name', 'description'];

    public function ingredients()
    {
        return $this->hasMany(Ingredient::class);
    }

    public function steps()
    {
        return $this->hasMany(Step::class)->orderBy('step_number');
    }
}
