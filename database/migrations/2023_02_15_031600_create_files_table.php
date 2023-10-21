<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id');
            $table->string('name');
            $table->text('location');
            $table->string('type')->default('Order File'); // default options are:
            // order file, final copy, draft, plagiarism report, etc
            $table->string('uploaded_by')->default('U');
            // U->User, W->Writer, C->Client, A->Admin, E->Editor
            $table->boolean('show_client')->default(false);
            $table->boolean('show_writer')->default(false);
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
        Schema::dropIfExists('files');
    }
};
