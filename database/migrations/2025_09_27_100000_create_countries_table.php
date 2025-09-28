<?php

use App\Models\Country;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create(Country::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('external_id');
            $table->string('title');
            $table->timestamps();

            $table->unique('external_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(Country::TABLE_NAME);
    }
};
