<?php

namespace App\Listeners;

use App\Events\UpdatedAddress;
use App\Models\UserPoint;
use App\User;
use Cassandra\Session;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class UserUpdatedAddress
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return true;
    }

    /**
     * Handle the event.
     *
     * @param  UpdatedAddress  $event
     * @return void
     */
    public function handle(UpdatedAddress $event)
    {
        //
        $user = User::find(Auth::id());
        $user->points += 5;

        $point = new UserPoint([
            "user_id" => $user->id,
            "amount" => 5,
            "created_at" => now(),
            "notes" => "更新完整個人資料"
        ]);

        $point->save();
        $user->save();


    }
}
