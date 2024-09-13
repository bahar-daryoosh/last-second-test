<?php

namespace App\Listeners;

use App\Events\BookingCreated;
use App\Jobs\SendBookingConfirmation;

class NotifyAdminOfBooking
{
    public function handle(BookingCreated $event)
    {
        SendBookingConfirmation::dispatch($event->booking);
    }
}
