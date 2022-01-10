<?php

namespace App\Http\Controllers;

use App\Models\DetailEvent;
use App\Models\Event;
use App\Models\KategoriUser;
use App\Models\User;
use App\Models\UserEvent;
use Illuminate\Http\Request;
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
        $events = Event::join('kategoris', 'kategoris.id', '=', 'events.kategori_id')
        ->where('jenis', $jenis)
        ->select('jenis', 'kategoris.nama', 'nama_event', 'date')->get();
        $eventList->event = $events;
        return response()->json($eventList);
    }

    public function pencarian(Request $request)
    {
        $eventList = new stdClass();
        $search = $request->input('search');
        if($search==null){
            $search ='';
        }
        $searchParam = '%'.$search.'%';
        $events = Event::join('kategoris', 'kategoris.id', '=', 'events.kategori_id')
        ->where('nama_event','like',$searchParam)
        ->select('jenis', 'kategoris.nama', 'nama_event', 'date')->get();
        $eventList->event = $events;
        return response()->json($eventList);
    }

    public function favorite($id)
    {
        $eventList = new stdClass();
        $favorite = KategoriUser::where('user_id', $id)->select('kategori_id')->pluck('kategori_id');
        $events = Event::join('kategoris', 'kategoris.id', '=', 'events.kategori_id')->whereIn('kategori_id', $favorite)->select('jenis', 'kategoris.nama', 'nama_event', 'date')->get();
        $eventList->favorite = $events;
        return response()->json($eventList);
    }

    public function myevent($user_id, $jenis)
    {
        $eventList = new stdClass();
        $myevent = UserEvent::join('events', 'events.id', '=', 'event_users.event_id')->join('kategoris', 'kategoris.id', '=', 'events.kategori_id')
            ->where('user_id', $user_id)->where('event_users.jenis', $jenis)->select('events.jenis', 'kategoris.nama', 'nama_event', 'date')->get();
        $eventList->myevent = $myevent;
        return response()->json($eventList);
    }

    public function detailEvent($id)
    {
        $dEvent = new stdClass();
        $event = DetailEvent::join('events', 'events.id', '=', 'detail_events.id')
        ->join('kategoris', 'kategoris.id', '=', 'events.kategori_id')
        ->where('detail_events.id',$id)
        ->first();
        $dEvent->detail_event = $event;
        return response()->json($dEvent);
    }
}
