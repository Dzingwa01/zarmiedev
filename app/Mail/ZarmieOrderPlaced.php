<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Order;
use App\User;

class ZarmieOrderPlaced extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
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
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
//        return $this->from('shane@zarmie.co.za')->view('emails.order_placed');
        return $this->markdown('emails.zarmie_order')->with([
            'order' => $this->order,
            'name'=>$this->user->name,
            'surname'=>$this->user->surname,
            'extra_info'=>$this->extra_info
        ]);
    }
}
