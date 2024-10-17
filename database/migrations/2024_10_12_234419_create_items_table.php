<?php

use App\Models\Client;
use App\Models\Item;
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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_id')->index()->onDelete('cascade');
            $table->foreignIdFor(Client::class)->index()->onDelete('cascade');
            $table->foreignIdFor(Item::class, 'parent_id')->index()->nullable();
            $table->string('name');
            $table->string('path')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('mime')->nullable();
            $table->integer('size')->default(0);
            $table->boolean('is_folder')->default(0);
            $table->boolean('is_external')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
