<?php

namespace App\Models;

use Aginev\SearchFilters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Recipe extends Model
{
    use HasApiTokens, HasFactory, Notifiable, Filterable;

    protected $fillable = [
        'name',
        'ingredients',
        'instructions',
        'image',
        'category_id',
        'difficulty',
        'cooking_time',
    ];
    protected $casts = [
        'difficulty' => 'integer',
        'cooking_time' => 'integer',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
