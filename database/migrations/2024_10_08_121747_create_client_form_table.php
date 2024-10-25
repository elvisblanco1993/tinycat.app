<?php

use App\Models\Client;
use App\Models\Form;
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
        Schema::create('form_client', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Client::class)->unique();
            $table->foreignIdFor(Form::class)->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_client');
    }
};
