<?php

namespace App\Jobs;

use App\Mail\PaymentSuccess;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendPaymentReceivedEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;
    public User $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user, $data)
    {
        // initialize
        $this->data = $data;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // send email
        Mail::to($this->user)->send(new PaymentSuccess($this->data));
    }
}
