<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;

class CreateHogeTable extends Migration
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
            $table->string('invalid');
            $table->string('name');
            $table->string('category_l');
            $table->string('category_s');
            $table->string('category');
            $table->integer('lunch')->nullable();
            $table->integer('walking')->nullable();
            $table->float('distance')->nullable();
            $table->string('url');
            $table->timestamps();
        });
        $reader = Reader::createFromPath('./test2.csv');
        $reader->setHeaderOffset(0);
        $records = $reader->getRecords();
        foreach ($records as $r) {
            print_r($r);
            $ri = $r;
            if ($ri['lunch'] == '') {
                $ri['lunch'] = NULL;
            }
            if ($ri['walking'] == '') {
                $ri['walking'] = NULL;
            }
            if ($ri['distance'] == '') {
                $ri['distance'] = NULL;
            }
            DB::table('hoge')->insert($ri);
            //DB::statement("INSERT INTO hoge (invalid,name,category_l,category_s,category,lunch,walking,distance,url) VALUES ('{$r['invalid']}','{$r['name']}','{$r['category_l']}','{$r['category_s']}','{$r['category']}',{$lnc},{$wlk},{$dst},'{$r['url']}');");
        }
        //DB::statement("COPY hoge (name,category_l,category_s,category,lunch,distance,url) FROM '".realpath("./test.csv")."' WITH CSV");
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
