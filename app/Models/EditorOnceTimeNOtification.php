<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EditorOnceTimeNOtification extends Model
{
    use HasFactory;
    
    protected $fillable  = [
        'editor_id',
        'field_name',
        'field_old_value',
        'field_new_value',
        'state',
    ];
}
