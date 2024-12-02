<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class auctionBidOwnMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $auctiondata = $this->data;
        //from website to woody email 
        return $this->from('info@woodyengineering.com')->view('mail.auctionBidOwnMail',compact('auctiondata'))->subject('Woody オークション 落札通知');
    }
}