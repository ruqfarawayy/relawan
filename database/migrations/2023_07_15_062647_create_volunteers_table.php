<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVolunteersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('volunteers', function (Blueprint $table) {
            $table->id();
            $table->string('nra')->unique();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('photo');
            $table->longText('address');
            $table->unsignedInteger('occupation_id');
            $table->unsignedInteger('education_id');
            $table->enum('blood_type', ['A', 'B', 'AB', 'O']);
            $table->enum('gender', ['m', 'f']);
            $table->date('birth_date');
            $table->unsignedInteger('unit_id');
            $table->unsignedInteger('volunteer_type_id');
            $table->boolean('status');
            $table->softDeletes();
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
        Schema::dropIfExists('volunteers');
    }
}
