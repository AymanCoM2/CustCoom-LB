<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardCode extends Model
{
    use HasFactory;

    protected $fillable  = ['cc'];

    public function scopeSearch($query, $searchTerm)
    {
        return $query->where('cc', 'LIKE', '%' . $searchTerm . '%');
    }
}
