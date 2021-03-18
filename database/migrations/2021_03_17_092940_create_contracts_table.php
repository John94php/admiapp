<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->string('name',255);
            $table->string('lastname',255);
            $table->string('pesel',11)->nullable();
            $table->date('dateofbirth')->nullable();
            $table->char('sex');
            $table->string('idcard',9);
            $table->string('contracttype',255);
            $table->date('contractdate');
            $table->string('corrcode',6);
            $table->string('corrcountry',255);
            $table->string('corrstate',255);
            $table->string('corrcity',255);
            $table->string('corrhouse');
            $table->string('corrflat');
            $table->string('code',6);
            $table->string('country',255);
            $table->string('city',255);
            $table->string('street',255);
            $table->string('house');
            $table->string('flat');
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
        Schema::dropIfExists('contracts');
    }
}
