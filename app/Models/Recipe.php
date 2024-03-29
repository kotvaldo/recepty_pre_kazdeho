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
        'user_id',
        'video_url',
        'description',
    ];
    protected $casts = [
        'difficulty' => 'integer',
        'cooking_time' => 'integer',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function setFilters()
    {
        $this->filter->like('name')
            ->like('ingredients')
            ->like('category_id')
            ->like('difficulty')
            ->like('cooking_time');

    }
}
