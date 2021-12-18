<?php

namespace App\Http\Controllers;

use App\Models\Event;
use stdClass;

class EventController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function show($jenis)
    {

        $eventList = new stdClass();
        $events = Event::join('kategoris', 'kategoris.id', '=', 'events.kategori_id')->where('jenis', $jenis)->select('jenis', 'kategori_id', 'nama_event', 'date')->get();
        $eventList->event = $events;
        return response()->json($eventList);
    }
}
