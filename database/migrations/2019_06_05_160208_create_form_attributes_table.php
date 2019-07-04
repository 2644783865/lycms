<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_attributes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('form_id', false, true)->default(0)->comment('模型id');
            $table->integer('attribute_id', false, true)->default(0)->comment('属性id');
            $table->integer('sort', false, true)->default(0)->comment('排序');
            $table->tinyInteger('required', false, true)->default(2)->comment('必填');
            $table->tinyInteger('show', false, true)->default(2)->comment('列表显示');
            $table->softDeletes();
            $table->unique(['form_id', 'attribute_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_attributes');
    }
}
