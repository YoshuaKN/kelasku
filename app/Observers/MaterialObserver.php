<?php

namespace App\Observers;

use App\material;

class MaterialObserver
{
    /**
     * Handle the material "created" event.
     *
     * @param  \App\material  $material
     * @return void
     */
    public function created(material $material)
    {
        //
    }

    /**
     * Handle the material "updated" event.
     *
     * @param  \App\material  $material
     * @return void
     */
    public function updated(material $material)
    {
        //
    }

    /**
     * Handle the material "deleted" event.
     *
     * @param  \App\material  $material
     * @return void
     */
    public function deleted(material $material)
    {
        //
    }

    /**
     * Handle the material "restored" event.
     *
     * @param  \App\material  $material
     * @return void
     */
    public function restored(material $material)
    {
        //
    }

    /**
     * Handle the material "force deleted" event.
     *
     * @param  \App\material  $material
     * @return void
     */
    public function forceDeleted(material $material)
    {
        //
    }
}
