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
        Schema::create('orders', function (Blueprint $table) {
            $table->id()->from(4267);
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('title', 1000)->default('Writers Choice');
            $table->foreignId('service_type_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('academic_level_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('subject_id')->nullable()->constrained();
            $table->longText('instructions');
            $table->integer('deadline')->default(48);
            $table->timestamp('due_at')->nullable();
            $table->integer('pages')->nullable()->default(1);
            $table->integer('slides')->nullable();
            $table->integer('sources')->nullable()->default(1);
            $table->foreignId('spacing_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('referencing_style_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('language_id')->nullable()->constrained();
            $table->foreignId('writer_category_id')->nullable()->constrained()->nullOnDelete();
            $table->double('amount', 8, 2)->nullable();
            $table->double('amount_due', 8, 2)->nullable();
            $table->foreignId('currency_id')->nullable()->constrained();
            $table->double('cpp', 8, 2)->nullable();
            $table->integer('discount_id')->nullable()->constrained();
            $table->boolean('paid')->default(false);
            $table->boolean('discounted')->nullable()->default(false);
            $table->text('referral_website')->nullable();
            $table->string('status')->nullable()->default('pending');
            // order->status = 'pending - if unpaid' || 'new - if paid=true'
            // || 'running -if assigned to writer', || 'submitted - if writer has sent it as completed'
            // || 'completed - if marked completed by admin or client' || 'cancelled - by client or admin'
            // || 'revision - if client wants changes'
            // || 'disputed - if client is unsatisfied with work and needs refund'
            $table->timestamp('writer_deadline')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->longText('revision_instructions')->nullable();
            $table->longText('cancel_reason')->nullable();
            $table->text('dispute_message')->nullable();
            $table->smallInteger('assigned_to')->nullable(); // assign to a writer @User::class->role === W;
            $table->string('files')->nullable();
            $table->softDeletes('deleted_at');
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
        Schema::dropIfExists('orders');
    }
};
