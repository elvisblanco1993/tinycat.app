<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Question extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'options' => 'array'
    ];

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }
}
