<?php

use App\Models\Deck;
use App\Models\Task;
use App\Models\User;
use App\Models\Client;
use App\Models\Project;
use App\Models\Milestone;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class, 'created_by')->onDelete('cascade')->nullable();
            $table->foreignIdFor(User::class, 'send_notification_to')->nullable();
            $table->foreignIdFor(Client::class)->nullOnDelete()->nullable();
            $table->foreignIdFor(Task::class, 'parent_task_id')->nullOnDelete()->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('priority', ['low', 'medium', 'high'])->nullable();
            $table->enum('status', ['pending', 'in_progress', 'completed'])->nullable();
            $table->date('due_date')->nullable();
            $table->json('recurrence_rule')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
