<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\MailProduct;
use Illuminate\Support\Facades\Mail;

class SendEmailProduct implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;
    // protected $products;

    /**
     * Create a new job instance.
     *
     * @param $data
     */
    public function __construct($data)
    {
        $this->data = $data;
        // $this->products = $products;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to(env('MAIL_USERNAME'))->send(new MailProduct($this->data));
    }
}
