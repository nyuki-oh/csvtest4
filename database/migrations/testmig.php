<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use DB

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hoge', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('category_l');
            $table->string('category_s');
            $table->string('category');
            $table->string('lunch');
            $table->string('distance');
            $table->string('url');
        });
        DB::statement('COPY hoge (name,category_l,category_s,category,lunch,distance,url) FROM "test.csv" WITH CSV');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hoge');
    }
}
