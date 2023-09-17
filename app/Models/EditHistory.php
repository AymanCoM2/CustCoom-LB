<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EditHistory extends Model
{
    use HasFactory;
    protected $fillable  = [
        'cardCode',
        'editor_id',
        'fieldName',
        'oldValue',
        'newValue',
        'isApproved'
    ];
}
