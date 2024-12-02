<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class auctionProductOwnerMail extends Mailable
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
        return $this->from('info@woodyengineering.com')->view('mail.auctionProductOwnerMail',compact('auctiondata'))->subject('Woody オークション成約機械通知');
    }
}
