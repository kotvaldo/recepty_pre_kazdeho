<?php

namespace App\Models;

use Aginev\SearchFilters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Category extends Model
{
    use HasApiTokens, HasFactory, Notifiable, Filterable;

    protected $fillable = [
        'name',
    ];

    public function setFilters()
    {
        $this->filter->like('name')
            ->like('created_at');
    }
}
