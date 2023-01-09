<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employers', function (Blueprint $table) {
            $table->id();
            $table->string('photo')->nullable();
            $table->string('name',256);
            $table->unsignedBigInteger('position_id')->nullable();
            $table->date('date_employment');
            $table->string('phone', 15);
            $table->string('email')->unique()->nullable(false);
            $table->float('salary');
            $table->nestedSet();
            $table->timestamps();
            $table->unsignedBigInteger('admin_created_id')->nullable();
            $table->unsignedBigInteger('admin_updated_id')->nullable();



            $table->index('position_id','employer_position_idx');
            $table->foreign('position_id', 'employer_position_fk')->on('positions')->references('id')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employers');
    }
};
