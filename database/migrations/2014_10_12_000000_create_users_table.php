<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('firstname');
            $table->string('surname');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('is_admin');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert(
            array(
                'username' => 'admin',
                'firstname' => 'Admin',
                'surname' => '',
                'password' => '$2a$12$8pIjfurF/iGeWxm5BbaHJuJW7Y4qeQUsIecKF3adBkUVdjCuLCFbC',
                'is_admin' => 1,
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
