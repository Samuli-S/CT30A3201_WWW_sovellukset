<?php
/* *
 * This migration has been offered predone by the Laravel-framework.
 * 'users'-table creation has been appended with last name and user name
 * columns.
 *
 * Migrations are used to create, modify and delete database tables.
 *
 * Migrations are created trough composer: composer make:migrate 
 * <migration name> <options>
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* Create table 'users' with specified columns in the
         * database specified in .env-file (or config/database.php).
         */
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');  // Appended Laravel baseline
            $table->string('city')->nullable();
            $table->string('country')->nullable();  // Appended Laravel baseline
            $table->string('gender')->nullable();  // Appended Laravel baseline
            $table->string('username')->unique();  // Appended Laravel baseline
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->string('profile_picture_path')->nullable();
            $table->rememberToken();  // 'Remember me'-implementation (not in use)
            $table->timestamps();  // Creation and modification timestamps
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /* Drop table 'users' from database specified in .env-file 
         * (or config/database.php).
         */
        Schema::drop('users');
    }
}
