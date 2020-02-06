<?php

namespace App\Observers;

use App\Kelas;
use Illuminate\Support\Facades\Auth;

class KelasObserver
{
    /**
     * Handle the kelas "created" event.
     *
     * @param  \App\Kelas  $kelas
     * @return void
     */
    public function created(Kelas $kelas)
    {
        $user = Auth::user();
        $kelas->user()->attach($user);
    }

    /**
     * Handle the kelas "updated" event.
     *
     * @param  \App\Kelas  $kelas
     * @return void
     */
    public function updated(Kelas $kelas)
    {
        //
    }

    /**
     * Handle the kelas "deleted" event.
     *
     * @param  \App\Kelas  $kelas
     * @return void
     */
    public function deleted(Kelas $kelas)
    {
        $kelas->user()->detach();
        $kelas->attendance()->get()->each(function ($child) {
            $child->delete();
        });
    }

    /**
     * Handle the kelas "restored" event.
     *
     * @param  \App\Kelas  $kelas
     * @return void
     */
    public function restored(Kelas $kelas)
    {
        //
    }

    /**
     * Handle the kelas "force deleted" event.
     *
     * @param  \App\Kelas  $kelas
     * @return void
     */
    public function forceDeleted(Kelas $kelas)
    {
        //
    }
}
