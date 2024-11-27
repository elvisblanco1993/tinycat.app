<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'project_id', 'created_by', 'deck_id', 'milestone_id', 'title', 'description', 'priority', 'status', 'due_date', 'progress',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function comments(): HasMany
    {
        return $this->hasMany(TaskComment::class)->chaperone();
    }

    public function labels(): BelongsToMany
    {
        return $this->belongsToMany(TaskLabel::class, 'task_label_task');
    }

    public function dependencies(): HasMany
    {
        return $this->hasMany(TaskDependency::class, 'dependent_task_id')->chaperone();
    }
}
