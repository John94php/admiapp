<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mails', function (Blueprint $table) {
            $table->id('mail_id');
            $table->string('mail_sender',255);
            $table->string('mail_recipient',255);
            $table->text('mail_title');
            $table->text('mail_body');
            $table->tinyInteger('mail_attachmentflag');
            $table->text('mail_attachmnet1');
            $table->text('mail_attachment2');
            $table->text('mail_attachmnet3');
            $table->text('mail_attachment4');
            $table->string('mail_dw',255);
            $table->string('mail_udw',255);
            $table->string('mail_folder',255);
            $table->string('mail_status',255);

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
        Schema::dropIfExists('mails');
    }
}
