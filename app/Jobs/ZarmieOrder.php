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
    public $ingredients;
    public function __construct(User $user,Order $order,$ingredients)
    {
        //
        $this->order = $order;
        $this->user = $user;
        $this->ingredients = $ingredients;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $email = new ZarmieOrderPlaced($this->user,$this->order,$this->ingredients);
//        Mail::to("shane@zarmie.co.za")->cc("tongaichiridza@gmail.com")->queue($email);
        Mail::to("tongaichiridza@gmail.com")->queue($email);

//        $this->release(2);
    }
}
