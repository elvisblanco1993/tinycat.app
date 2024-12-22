<?php

use App\Models\Audience;
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
        Schema::create('email_broadcasts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Team::class);
            $table->string('title');
            $table->string('reply_to')->nullable();
            $table->foreignIdFor(Audience::class)->nullable();
            $table->timestamp('send_at')->nullable();
            $table->string('preview')->nullable();
            $table->string('subject')->nullable();
            $table->text('message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_broadcasts');
    }
};
