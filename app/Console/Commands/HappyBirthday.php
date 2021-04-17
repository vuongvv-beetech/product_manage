<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class HappyBirthday extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'happy:birthday';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now = Carbon::now();
        $day = $now->day;
        $month = $now->month;
        $users = User::where('birthday', 'like', '%' . $month . '-' . $day . '%')
                ->select('email')
                ->get();

        foreach ($users as $user) {
            Mail::raw("Best wishes for you", function ($mail) use ($user) {
                $mail->from(env('MAIL_USERNAME'));
                $mail->to($user->email)
                    ->subject('Happy Birthday');
            });
        }
    }
}
