<?php

namespace HomeSecretary\Jobs;

use Carbon\Carbon;
use HomeSecretary\Occasion;
use HomeSecretary\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

class SendReminders implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {

        $upcomingOccasionsInHour = Occasion::with('users')
            ->where('from_date', Carbon::now()->addHour())
            ->get();

        foreach ($upcomingOccasionsInHour as $occasion) {
            foreach ($occasion->users as $user) {
                Mail::to($user)
                    ->queue(new OccasionMail($occasion));
            }
        };

        $upcomingOccasionsInDay = Occasion::with('users')
            ->where('from_date', Carbon::now()->addDay())
            ->get();

        foreach ($upcomingOccasionsInHour as $occasion) {
            foreach ($occasion->users as $user) {
                Mail::to($user)
                    ->queue(new OccasionMail($occasion));
            }
        };


        $upcomingOccasionsInWeek = Occasion::with('users')
            ->where('from_date', Carbon::now()->addWeek())
            ->get();

        foreach ($upcomingOccasionsInHour as $occasion) {
            foreach ($occasion->users as $user) {
                Mail::to($user)
                    ->queue(new OccasionMail($occasion));

            }
        };

        $upcomingOccasionsInMonth = Occasion::with('users')
            ->where('from_date', Carbon::now()->addMonth())
            ->get();

        foreach ($upcomingOccasionsInHour as $occasion) {
            foreach ($occasion->users as $user) {
                Mail::to($user)
                    ->queue(new OccasionMail($occasion));

            }
        };

    }
}
