<?php
/* *
 * This migration has been offered predone by the Laravel-framework.
 * No modifications have been made (won't be used in this web application).
 *
 * Migrations are used to create, modify and delete database tables.
 *
 * Migrations are created trough composer: composer make:migrate 
 * <migration name> <options>
 */

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePasswordResetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /* Create table 'password_resets' with specified columns in the
         * database specified in .env-file (or config/database.php).
         */
        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token')->index();
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        /* Drop table 'password_resets' from database specified in .env-file 
         * (or config/database.php).
         */
        Schema::drop('password_resets');
    }
}
