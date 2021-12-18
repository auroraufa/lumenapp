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
        return response()->json([
            'message' => 'Masuk kesini kok'
        ]);
        $eventList = new stdClass();
        $events = Event::where('jenis', $jenis) -> select ('jenis', 'kategori_id', 'nama_event', 'date')->get();
        $eventList-> event= $events;
        return response()->json($eventList);
    }


}
