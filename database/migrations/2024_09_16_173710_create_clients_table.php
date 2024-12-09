<?php

use App\Models\Team;
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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Team::class);
            $table->foreignIdFor(User::class, 'owner_id');
            $table->string('name');
            $table->string('dba')->nullable();
            $table->string('business_type')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('itin')->unique()->index()->nullable();
            $table->string('address')->nullable();
            $table->string('address_ext')->nullable();
            $table->string('city', 100)->nullable();
            $table->char('state', 2)->nullable();
            $table->char('zip', 10)->nullable();
            $table->string('country', 100)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
