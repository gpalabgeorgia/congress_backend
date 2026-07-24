<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();

            // ბმული მშობელ პუნქტზე (null, თუ ეს მთავარი პუნქტია)
            $table->foreignId('parent_id')
                ->nullable()
                ->constrained('menu_items')
                ->nullOnDelete();

            $table->string('title')->comment('სახელი');
            $table->string('url')->nullable()->comment('ბმული');
            $table->integer('sort_order')->default(0)->comment('რიგითობა');
            $table->boolean('is_active')->default(true);
            $table->boolean('target_blank')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_items');
    }
}
