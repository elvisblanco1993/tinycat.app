<?php

use App\Models\Client;
use App\Models\Deck;
use App\Models\Milestone;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->foreignIdFor(Client::class)->nullOnDelete()->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('priority', ['low', 'medium', 'high'])->nullable();
            $table->enum('status', ['pending', 'in_progress', 'completed'])->nullable();
            $table->date('due_date')->nullable();
            $table->integer('progress')->default(0);
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
