<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ColumnType extends Model
{
    use HasFactory;

    protected $fillable  = [
        'colName',
        'colType',
        'optionName',
    ];
}
