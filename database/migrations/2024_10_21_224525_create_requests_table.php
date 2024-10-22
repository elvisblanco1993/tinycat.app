<?php

use App\Models\Item;
use App\Models\Team;
use App\Models\User;
use App\Models\Client;
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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->ulid()->index();
            $table->foreignIdFor(Team::class)->onDelete('cascade');
            $table->foreignIdFor(Client::class)->onDelete('cascade');
            $table->foreignIdFor(Item::class)->nullOnDelete();
            $table->text('message')->nullable();
            $table->foreignIdFor(User::class, 'completed_by')->nullOnDelete()->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
