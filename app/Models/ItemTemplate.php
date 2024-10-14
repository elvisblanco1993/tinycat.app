<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemTemplate extends Model
{
    /** @use HasFactory<\Database\Factories\ItemTemplateFactory> */
    use HasFactory;

    protected $fillable = [
        'team_id',
        'name',
        'children',
    ];
}
