<?php

namespace App\Observers;

use App\Models\{UnitUser, PasswordHistory};

class UnitUserObserver
{
    /**
     * Handle the UnitUser "created" event.
     */
    public function created(UnitUser $unitUser): void
    {
        //
    }

    /**
     * Handle the UnitUser "updated" event.
     */
    public function updated(UnitUser $unitUser): void
    {
        if($unitUser->isDirty('password')){
            PasswordHistory::create([
                'user_id' => $unitUser->id,
                'password' => $unitUser->password,
            ]);
        }
    }

    /**
     * Handle the UnitUser "deleted" event.
     */
    public function deleted(UnitUser $unitUser): void
    {
        //
    }

    /**
     * Handle the UnitUser "restored" event.
     */
    public function restored(UnitUser $unitUser): void
    {
        //
    }

    /**
     * Handle the UnitUser "force deleted" event.
     */
    public function forceDeleted(UnitUser $unitUser): void
    {
        //
    }
}
