<?php

namespace App\Providers;

use App\Events\OmniChannelRequest;
use App\Services\OmniChannel\Manager;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ListOnOtherMarkets implements ShouldQueue
{
    use InteractsWithQueue;
    /**
     * Handle the event.
     *
     * @param  OmniChannelRequest  $event
     * @return void
     */
    public function handle(OmniChannelRequest $event)
    {
        $markets = explode(',', $event->markets);
        $book = $event->book;
        Manager::publishOn($markets, $book);
    }
}
