<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('root_id', false, true)->default(0)->comment('根ID');
            $table->bigInteger('parent_id', false, true)->default(0)->comment('父ID');
            $table->string('name', 64)->default('')->comment('名称');
            $table->integer('sort', false, true)->default(0)->comment('排序');
            $table->integer('depth', false, true)->default(0)->comment('深度');
            $table->tinyInteger('status', false, true)->default(1)->comment('状态');
            $table->string('path', 128)->default('')->comment('路径');
            $table->string('level', 128)->default('')->comment('级别');
            $table->string('remark', 128)->default('')->comment('备注');
            $table->timestamps();
            $table->softDeletes();

            $table->index('root_id');
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
        Schema::dropIfExists('trees');
    }
}
