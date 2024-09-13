<?php

namespace App\Listeners;

use App\Events\BookingCreated;
use App\Jobs\NotifyAdminOfBooking;

class NotifyAdminOfBooking
{
    public function handle(BookingCreated $event)
    {
        NotifyAdminOfBooking::dispatch($event->booking);
    }
}
