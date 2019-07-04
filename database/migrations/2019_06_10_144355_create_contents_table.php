<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('form_id', false, true)->default(0)->comment('表单ID');
            $table->string('title', 64)->default('')->comment('标题');
            $table->string('cover', 128)->default('')->comment('封面');
            $table->tinyInteger('status', false, true)->default(2)->comment('状态:1启用2禁用');
            $table->bigInteger('page_view', false, true)->default(0)->comment('浏览量');
            $table->integer('top', false, true)->default(0)->comment('置顶');
            $table->timestamps();
            $table->softDeletes();
            $table->index('title');
            $table->index('form_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contents');
    }
}
