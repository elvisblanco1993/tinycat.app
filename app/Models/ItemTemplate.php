<?php

namespace App\Models;

use App\Models\Scopes\ItemTemplateScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[ScopedBy(ItemTemplateScope::class)]
class ItemTemplate extends Model
{
    /** @use HasFactory<\Database\Factories\ItemTemplateFactory> */
    use HasFactory;

    protected $fillable = [
        'team_id',
        'name',
        'folders',
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
