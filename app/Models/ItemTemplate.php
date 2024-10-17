<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\ItemTemplateScope;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
