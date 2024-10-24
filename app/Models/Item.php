<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    /** @use HasFactory<\Database\Factories\ItemFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'team_id',
        'client_id',
        'parent_id',
        'request_id',
        'name',
        'is_folder',
        'is_external',
        'path',
        'thumbnail',
        'mime',
        'size',
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function request(): BelongsTo
    {
        return $this->belongsTo(Request::class);
    }

    public function getAncestors()
    {
        $ancestors = collect();
        $parent = $this->parent;
        while ($parent) {
            $ancestors->prepend($parent);
            $parent = $parent->parent;
        }
        return $ancestors;
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Item::class, 'parent_id');
    }

    public function subdirectories(): HasMany
    {
        return $this->hasMany(Item::class, 'parent_id')->where('is_folder', 1);
    }

    public function children(): HasMany
    {
        return $this->hasMany(Item::class, 'parent_id');
    }

    /**
     * Convert bytes to a human-readable format (KB, MB, GB, etc.).
     *
     * @param int $bytes
     * @param int $precision
     * @return string
     */
    function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB'];
        if ($bytes == 0) {
            return '0 B';
        }
        $exponent = (int) floor(log($bytes, 1024));
        $exponent = min($exponent, count($units) - 1);
        $size = $bytes / pow(1024, $exponent);
        return round($size, $precision) . ' ' . $units[$exponent];
    }
}
