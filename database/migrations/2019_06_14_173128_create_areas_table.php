<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('parent_id', false, true)->default(0)->comment('父ID');
            $table->string('name', 64)->default('')->comment('名称');
            $table->string('short_name', 64)->default('')->comment('简称');
            $table->string('full_name', 128)->default('')->comment('全称');
            $table->integer('depth', false, true)->default(0)->comment('深度');
            $table->tinyInteger('status', false, true)->default(1)->comment('状态');
            $table->string('path', 128)->default('')->comment('路径');
            $table->timestamps();
            $table->softDeletes();
            $table->index('parent_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('areas');
    }
}
