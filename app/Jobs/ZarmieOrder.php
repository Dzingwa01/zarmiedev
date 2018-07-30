<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Order;
use App\User;
use App\Mail\ZarmieOrderPlaced;
use Illuminate\Support\Facades\Mail;

class ZarmieOrder implements ShouldQueue
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
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $email = new ZarmieOrderPlaced($this->user,$this->order,$this->extra_info);
        Mail::to("shane@zarmie.co.za")->cc("tongaichiridza@gmail.com")->queue($email);
//        Mail::to("tongaichiridza@gmail.com")->queue($email);

//        $this->release(2);
    }
}
