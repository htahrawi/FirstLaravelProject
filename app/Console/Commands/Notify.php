<?php

namespace App\Console\Commands;

use App\Mail\NotifyEmail;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class Notify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email notify for all users every day';

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
        // $emails = User::select('email')->get();
        $emails = User::pluck('email')->toArray(); // in another way
        $data = ['title'=> 'Programming', 'body' => 'php'];
        foreach ($emails as $email) {
            // how to send emails in laravel
            Mail::to($email) -> send(new NotifyEmail($data));
        }
    }
}
