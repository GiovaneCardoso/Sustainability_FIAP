<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_rating', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('company_id');

            $table->enum('rating', [
                '1',
                '2',
                '3',
                '4',
                '5',
            ]);

            $table->string('comment');

            $table->foreign('company_id')->references('id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_rating');
    }
}
