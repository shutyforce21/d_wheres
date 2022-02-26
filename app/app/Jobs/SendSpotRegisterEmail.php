<?php

namespace App\Jobs;

use App\Mail\SpotRegisterEmail;
use App\Packages\User\Domain\Spot\Spot;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendSpotRegisterEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $spot;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Spot $spot)
    {
        $this->spot = $spot;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to('admin@hoge.co.jp')->send(new SpotRegisterEmail($this->spot));
    }
}
