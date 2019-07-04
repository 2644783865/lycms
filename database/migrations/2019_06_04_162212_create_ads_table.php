<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('position_id', false, true)->default(0)->comment('广告位ID');
            $table->string('title', 64)->default('')->comment('标题');
            $table->string('subtitle', 128)->default('')->comment('副标题');
            $table->string('image', 256)->default('')->comment('广告图');
            $table->integer('sort', false, true)->default(0)->comment('排序');
            $table->tinyInteger('status')->default(1)->comment('状态：1启用,2禁用');
            $table->integer('target_type')->default(0)->comment('链接类型');
            $table->text('target')->nullable()->comment('链接内容');
            $table->timestamp('start_time')->nullable()->comment('开始时间');
            $table->timestamp('end_time')->nullable()->comment('结束时间');
            $table->timestamps();
            $table->softDeletes();
            $table->index('position_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ads');
    }
}
