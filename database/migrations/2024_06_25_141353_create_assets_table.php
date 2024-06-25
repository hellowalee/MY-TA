<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('right_type', 50);
            $table->string('certificate_number', 191)->nullable();
            $table->string('registration_number', 191);
            $table->string('asset_type', 50);
            $table->string('asset_name', 200);
            $table->string('NUP', 3);
            $table->double('asset_area', 8, 2);
            $table->year('year_of_acquisition');
            $table->integer('acquisition_value');
            $table->decimal('current_asset_value', 10, 0)->nullable();
            $table->string('location_latitude', 191);
            $table->string('location_longitude', 191);
            $table->string('allocation', 191);
            $table->string('application', 50)->nullable();
            $table->text('description');
            $table->string('available_rent', 50);
            $table->string('picture', 191)->nullable();
            $table->string('picture1', 191)->nullable();
            $table->string('picture2', 191)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assets');
    }
}
