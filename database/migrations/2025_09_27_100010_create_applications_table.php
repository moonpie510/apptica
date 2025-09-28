<?php

use App\Models\Application\Application;
use App\Models\Application\ApplicationTopHistory;
use App\Models\Country;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create(Application::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('external_id');
            $table->string('title');
            $table->timestamps();

            $table->unique('external_id');
        });

        Schema::create(ApplicationTopHistory::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('application_id');
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('sub_category_id')->nullable();
            $table->timestamp('date');
            $table->unsignedBigInteger('position');
            $table->timestamps();

            $table->foreign('application_id')->references('id')->on(Application::TABLE_NAME);
            $table->foreign('country_id')->references('id')->on(Country::TABLE_NAME);

            $table->unique(['application_id', 'country_id', 'category_id', 'sub_category_id', 'date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(ApplicationTopHistory::TABLE_NAME);
        Schema::dropIfExists(Application::TABLE_NAME);
    }
};
