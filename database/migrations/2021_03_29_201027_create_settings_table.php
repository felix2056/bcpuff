<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable();
            $table->string('title')->nullable()->default('BCPUFF');
            $table->string('sub_title')->nullable()->default('Sub Title');
            $table->text('info')->nullable()->default('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam mi ex, volutpat id nisl a, aliquet tincidunt risus. Vivamus id consectetur magna. Mauris vitae nulla risus. Maecenas eget tellus sit amet neque imperdiet suscipit. Donec elementum, metus vitae pulvinar sagittis, dolor orci condimentum velit, quis tempus ipsum risus non tortor.');
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
        Schema::dropIfExists('settings');
    }
}
