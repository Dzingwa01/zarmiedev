<?php

namespace App\Jobs;

use App\Mail\OrderPlaced;
use App\Order;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class OrderPlacedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $order;
    public $user;
    public $extra_info;
    public function __construct(User $user,$order,$extra_info)
    {
        //
        $this->order = $order;
        $this->user = $user;
        $this->extra_info = $extra_info;
//        $this->ingredients = $ingredients;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $email = new OrderPlaced($this->user,$this->order,$this->extra_info);
        Mail::to($this->user->email)->queue($email);
//        $this->release(2);
    }
}
