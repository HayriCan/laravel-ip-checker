<?php

/**
 * Laravel IP Checker
 *
 * @author    Hayri Can BARÇIN <hayricanbarcin (#) gmail (.) com>
 * @license   http://www.opensource.org/licenses/mit-license.php MIT
 * @link      https://github.com/HayriCan/laravel-ip-checker
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIpListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ip_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('group');
            $table->string('definition');
            $table->string('ip');
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
        Schema::dropIfExists('ip_lists');
    }
}
