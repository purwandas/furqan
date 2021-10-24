<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProvinceIdAndCityIdToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasColumn('users', 'province_id'))
        Schema::table('users', function (Blueprint $table) {

            $table->string('status')->nullable()->after('password');
            $table->string('phone_number')->nullable()->after('email');

            $table->unsignedBigInteger('city_id')->nullable()->after('id');
            $table->foreign('city_id')->references('id')->on('cities');
            
            $table->unsignedBigInteger('province_id')->nullable()->after('id');
            $table->foreign('province_id')->references('id')->on('provinces');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('users', 'province_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropForeign(['province_id', 'city_id']);
            });
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn(['province_id', 'city_id', 'phone_number', 'status']);
            });
        }
    }
}
