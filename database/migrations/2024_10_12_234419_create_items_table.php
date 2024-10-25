<?php

use App\Models\Client;
use App\Models\Item;
use App\Models\Request;
use App\Models\Team;
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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Team::class)->index()->onDelete('cascade');
            $table->foreignIdFor(Client::class)->index()->onDelete('cascade');
            $table->foreignIdFor(Item::class, 'parent_id')->index()->nullable();
            $table->foreignIdFor(Request::class, 'request_id')->index()->nullable();
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
