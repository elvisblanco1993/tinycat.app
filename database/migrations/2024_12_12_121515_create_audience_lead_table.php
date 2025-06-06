<?php

use App\Models\Audience;
use App\Models\Lead;
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
        Schema::create('audience_lead', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Audience::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Lead::class)->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audience_lead');
    }
};
