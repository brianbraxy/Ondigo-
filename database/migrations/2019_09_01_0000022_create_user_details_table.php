<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table)
        {
            $table->increments('id');

            $table->integer('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');

            // $table->integer('country_id')->unsigned()->index();
            // $table->foreign('country_id')->references('id')->on('countries')->onUpdate('cascade')->onDelete('cascade');

            $table->boolean('email_verification')->default(false);
            $table->string('phone_verification_code', 6)->nullable();
            $table->string('two_step_verification_type', 21)->default('disabled')->comment('disabled, email, phone, google_authenticator');
            $table->string('two_step_verification_code', 6)->nullable();
            $table->boolean('two_step_verification')->default(false);
            $table->timestamp('last_login_at')->nullable();
            $table->string('last_login_ip', 45)->nullable();
            $table->string('gender', 25)->nullable();
            $table->string('state_of_origin', 25)->nullable();
            $table->string('lga', 25)->nullable()->comment("Local Government Area");
            $table->string('nationality', 25)->nullable();
            $table->string('marital_status', 25)->nullable();
            $table->text('residential_address')->nullable();
            $table->string('residential_city', 25)->nullable();
            $table->string('residential_state', 25)->nullable();
            $table->string('means_od_id', 25)->nullable();
            $table->string('id_number', 25)->nullable();
            $table->string('nin_number', 25)->nullable();
            $table->string('bvn_number', 25)->nullable();
            $table->string('nok_last_name', 25)->nullable()->comment("next of kin");
            $table->string('nok_first_name', 25)->nullable();
            $table->string('nok_relationship', 25)->nullable();
            $table->string('nok_gender', 25)->nullable();
            $table->string('nok_address', 25)->nullable();
            $table->string('nok_city', 25)->nullable();
            $table->string('nok_lga', 25)->nullable();
            $table->string('nok_email', 25)->nullable();
            $table->string('employer_last_name', 25)->nullable();
            $table->string('employer_first_name', 25)->nullable();
            $table->string('employer_address', 25)->nullable();
            $table->string('employer_city', 25)->nullable();
            $table->string('employer_lga', 25)->nullable();
            $table->string('employer_email', 25)->nullable();
            $table->string('bank_name', 100)->nullable();
            $table->string('account_number', 25)->nullable();
            $table->string('account_name', 100)->nullable();
            $table->string('default_currency', 10)->nullable();
            $table->string('timezone')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_details');
    }
}
