<?php

namespace App\Observers;

use App\Material;

class MaterialObserver
{
    /**
     * Handle the material "created" event.
     *
     * @param  \App\material  $material
     * @return void
     */
    public function created(Material $material)
    {
        //
    }

    /**
     * Handle the material "updated" event.
     *
     * @param  \App\material  $material
     * @return void
     */
    public function updated(Material $material)
    {
        //
    }

    /**
     * Handle the material "deleted" event.
     *
     * @param  \App\material  $material
     * @return void
     */
    public function deleted(Material $material)
    {
        $material->file()->get()->each(function ($file) {
            $file->delete();
        });
    }

    /**
     * Handle the material "restored" event.
     *
     * @param  \App\material  $material
     * @return void
     */
    public function restored(Material $material)
    {
        //
    }

    /**
     * Handle the material "force deleted" event.
     *
     * @param  \App\material  $material
     * @return void
     */
    public function forceDeleted(Material $material)
    {
        //
    }
}
