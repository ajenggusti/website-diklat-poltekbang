<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Diklat;
use Illuminate\Http\Request;
use App\Http\Requests\EventRequest;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('kelola.kelEvent.event');
    }

    public function listEvent(Request $request)
    {
        $this->authorize('viewAny', Event::class);
        // dd($request->all());
        // $start = date('Y-m-d', strtotime($request->start));
        // $end = date('Y-m-d', strtotime($request->end));
        $events = Event::get()
            ->map(function ($item) {
                if ($item->id_diklat) {
                    return [
                        'id' => $item->id,
                        'title' => $item->diklat->nama_diklat,
                        'start' => $item->start_date,
                        'end' => date('Y-m-d', strtotime($item->end_date . '+1 days')),
                        'category' => $item->category,
                        'className' => ['bg-' . $item->category]
                    ];
                } else {
                    return [
                        'id' => $item->id,
                        'title' => $item->title,
                        'start' => $item->start_date,
                        'end' => date('Y-m-d', strtotime($item->end_date . '+1 days')),
                        'category' => $item->category,
                        'className' => ['bg-' . $item->category]
                    ];
                }
            });

        // dd($events);
        return response()->json($events);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Event $event)
    {
        // dd($event->all());
        $diklats = Diklat::get();
        return view('kelola.kelEvent.event-form', [
            'data' => $event,
            'diklats' => $diklats,
            'action' => route('events.store')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $request, Event $event)
    {
        // dd($request);
        return $this->update($request, $event);
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        $diklats = Diklat::all();
        return view('kelola.kelEvent.event-form', [
            'data' => $event,
            'diklats' => $diklats,
            'action' => route(
                'events.update',
                $event->id,
            )
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventRequest $request, Event $event)
    {
        // dd($request);
        if ($request->has('delete')) {
            return $this->destroy($event);
        }
        if ($request->id_diklat) {
            $event->start_date = $request->start_date;
            $event->end_date = $request->end_date;
            $event->id_diklat = $request->id_diklat;
            $event->title = null;
            $event->category = $request->category;
            $event->save();
        } else {
            $event->id_diklat = null;
            $event->start_date = $request->start_date;
            $event->end_date = $request->end_date;
            $event->title = $request->title;
            $event->category = $request->category;
            $event->save();
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Save data successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        // dd($event);
        $event->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Delete data successfully'
        ]);
    }
}
