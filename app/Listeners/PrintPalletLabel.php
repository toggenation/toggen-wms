<?php

namespace App\Listeners;

use App\Events\PalletLabelPrint;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PrintPalletLabel
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
     * Handle the event.
     *
     * @param  PalletLabelPrint  $event
     * @return void
     */
    public function handle(PalletLabelPrint $event)
    {
        var_dump("Inside print pallet label listener");
    }
}
