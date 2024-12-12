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
            $table->foreignIdFor(Audience::class);
            $table->string('reply_to')->nullable();
            $table->string('subject');
            $table->string('preview_text')->nullable();
            $table->text('message');
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
