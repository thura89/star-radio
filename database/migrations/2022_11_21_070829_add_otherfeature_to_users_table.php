<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOtherfeatureToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->unique();
            $table->text('description')->nullable();
            $table->text('address')->nullable();
            $table->smallInteger('user_type')->nullable();
            $table->string('theme')->nullable();
            $table->string('profile_photo')->nullable();
            $table->string('cover_photo')->nullable();
            $table->string('verify_code')->nullable();
            $table->string('facebook_id')->nullable();
            $table->string('google_id')->nullable();
            $table->string('ip')->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamp('login_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone');
            $table->dropColumn('description');
            $table->dropColumn('address');
            $table->dropColumn('user_type');
            $table->dropColumn('theme');
            $table->dropColumn('profile_photo');
            $table->dropColumn('cover_photo');
            $table->dropColumn('verify_code');
            $table->dropColumn('facebook_id');
            $table->dropColumn('google_id');
            $table->dropColumn('ip');
            $table->dropColumn('user_agent');
            $table->dropColumn('login_at');
        });
    }
}
