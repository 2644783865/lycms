<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_attributes', function (Blueprint $table) {
            $table->integer('content_id', false, true)->default(0)->comment('内容id');
            $table->integer('attribute_id', false, true)->default(0)->comment('属性id');
            $table->text('attribute_value')->nullable()->comment('属性值');
            $table->unique(['content_id', 'attribute_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('content_attributes');
    }
}
