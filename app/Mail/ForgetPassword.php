<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgetPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($content,$detail)
    {
        //
        $this->content = $content;
        $this->detail = $detail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->replaceContent();
       
        return $this->from($address = env('MAIL_FROM_ADDRESS'), $name = $this->detail['shop_name'])
            ->subject('Reset Password')->view('admin/mailMessage')
            ->with([
            'content' => $this->content,           
        ]); 
    }

    public function replaceContent() {
        $data = ["{{name}}", "{{password}}","{{shop_name}}"];   
        $this->content = str_replace($data, $this->detail, $this->content);
    }
}
