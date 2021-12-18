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
         return response()->json([
            'message' => 'Masuk kesini kok'
        ]);
        $events = Event::where('jenis', $jenis) -> select ('jenis', 'kategori_id', 'nama_event', 'date')->get();
        $eventList-> event= $events;
        return response()->json($eventList);
    }


}
