<?php

namespace App\Observers;

use App\file;
use Illuminate\Support\Facades\Storage;

class FileObserver
{
    /**
     * Handle the file "created" event.
     *
     * @param  \App\file  $file
     * @return void
     */
    public function created(file $file)
    {
        //
    }

    /**
     * Handle the file "updated" event.
     *
     * @param  \App\file  $file
     * @return void
     */
    public function updated(file $file)
    {
        //
    }

    /**
     * Handle the file "deleted" event.
     *
     * @param  \App\file  $file
     * @return void
     */
    public function deleted(file $file)
    {
        Storage::delete($file->path);
    }

    /**
     * Handle the file "restored" event.
     *
     * @param  \App\file  $file
     * @return void
     */
    public function restored(file $file)
    {
        //
    }

    /**
     * Handle the file "force deleted" event.
     *
     * @param  \App\file  $file
     * @return void
     */
    public function forceDeleted(file $file)
    {
        //
    }
}
