<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadEmails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lead_emails', function (Blueprint $table) {
            //$table->id();
            $table->string('email')->primary();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('telephone')->nullable();
            $table->boolean('privacy');
            $table->boolean('privacy_marketing')->default(false);
            $table->boolean('privacy_third_party')->default(false);
            $table->timestamps();

            $table->foreign('email')->references('email')->on('logbook');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lead_emails');
    }
}
