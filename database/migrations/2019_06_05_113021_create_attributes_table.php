<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attributes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code', 64)->default('')->unique()->comment('编码');
            $table->string('name', 64)->default('')->comment('名称');
            $table->string('alias_name', 64)->default('')->comment('别名');
            $table->text('value')->nullable()->comment('备选值');
            $table->bigInteger('tree_id', false, true)->default(0)->comment('树ID');
            $table->tinyInteger('status', false, true)->default(1)->comment('状态');
            $table->string('input', 16)->default('')->comment('类型');
            $table->string('unit', 16)->default('')->comment('单位');
            $table->string('placeholder', 128)->default('')->comment('提示文字');
            $table->string('remark', 128)->default('')->comment('备注');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attributes');
    }
}
