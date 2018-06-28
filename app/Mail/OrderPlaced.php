<?php

namespace App\Mail;

use App\Order;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderPlaced extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $order;
    public $user;
    public function __construct(User $user,Order $order)
    {
        //
        $this->order = $order;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
//        return $this->from('shane@zarmie.co.za')->view('emails.order_placed');
        return $this->markdown('emails.order_placed')->with([
            'order' => $this->order,
            'name'=>$this->user->name,
            'surname'=>$this->user->surname,
        ]);
    }
}
