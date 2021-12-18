<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\KategoriUser;
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
        $events = Event::join('kategoris', 'kategoris.id', '=', 'events.kategori_id')->where('jenis', $jenis)->select('jenis', 'kategoris.nama', 'nama_event', 'date')->get();
        $eventList->event = $events;
        return response()->json($eventList);
    }

    public function favorite($id)
    {
        $eventList = new stdClass();
        $favorite = KategoriUser::where('user_id', $id)->select('kategori_id')->list('kategori_id')->toArray();
        dd($favorite);
        return response()->json($eventList);
    }
}
