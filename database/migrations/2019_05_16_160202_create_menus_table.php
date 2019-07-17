<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('parent_id', false, true)->default(0)->comment('父ID');
            $table->string('name', 32)->default('')->comment('菜单名称');
            $table->string('link', 128)->default('')->comment('链接地址');
            $table->string('route', 32)->default('')->comment('路由');
            $table->string('icon', 32)->default('')->comment('icon');
            $table->tinyInteger('show', false, true)->default(1)->comment('显示：1显示2不显示');
            $table->integer('sort', false, true)->default(0)->comment('排序');
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
        Schema::dropIfExists('menus');
    }
}
