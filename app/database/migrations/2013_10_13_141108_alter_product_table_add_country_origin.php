<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterProductTableAddCountryOrigin extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::table('product', function($table)
        {
            $table->integer('country_id')->nullable()->index()->after('name_2');
            $table->integer('origin_id')->nullable()->index()->after('country_id');
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::table('product', function($table)
        {
            $table->dropColumn('country_id');
            $table->dropColumn('origin_id');
        });
    }

}