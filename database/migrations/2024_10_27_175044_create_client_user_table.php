<?php

use App\Models\Client;
use App\Models\User;
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
        Schema::create('client_user', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Client::class)->index()->nullOnCascade();
            $table->foreignIdFor(User::class)->index()->nullOnCascade();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_user');
    }
};
