<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use App\Models\Airport;
use App\Models\Country;
use Illuminate\Http\Request;

class AirportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $airports = Airport::latest()->paginate(5);
        // $airlines = Airline::get();
        // dd($airlines);
        return view('index')->with('airports', $airports);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countrys = Country::orderBy('name', 'desc')->get();
        $airlines = Airline::orderBy('name', 'desc')->get();
        return view('create', compact('countrys', 'airlines'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $this->validate(
            $request,
            [
                'country_id' => 'required|numeric',
                'name' => 'required|string|max:56|min:4',
                'longitude' => 'required|min:-180|max:80',
                'longitude' => 'required|min:-90|max:90',
            ],

            [
                'country_id.required' => 'Pasirinkite Šalį',
                'name.required' => 'Neteisingas pavadinimas',
                'name.min' => 'maŽiausiai 4 raidės',
                'longitude.required' => 'Kordinačių aukelis privalomas',
                'latitude.required' => 'Laukelis privalomas',
            ]
        );


        $airport = new Airport();
        $airport->country_id = $request->country_id;
        $airport->name = $request->name;
    
        $airport->longitude = $request->longitude;
        $airport->latitude = $request->latitude;

        $airlinesIds = $request->input('airlines');
        // dd(count($airlinesIds));
        $airport->save();
        if ($airlinesIds) {

            for ($i = 0; $i < count($airlinesIds); $i++) {
                $airport->airline()->attach($airlinesIds[$i]);
            }
        }
        // dd($airport);



        session()->flash('success', 'Nauja kategorija sukurta');
        return redirect()->route('index');
    }

    public function edit($id)
    {
        $airport = Airport::find($id);
        $countrys = Country::orderBy('name', 'desc')->get();
        $airlines = Airline::orderBy('name', 'desc')->get();
        // dd($airlines);
        if (!is_null($airport)) {
            return view('edit', compact('airport', 'countrys', 'airlines'));
        } else {
            return redirect()->route('index');
        }
    }

    public function update(Request $request, $id)
    {

        $this->validate(
            $request,
            [
                'country_id' => 'required|numeric',
                'name' => 'required|string|max:56|min:4',
                'longitude' => 'required|min:-180|max:80',
                'longitude' => 'required|min:-90|max:90',
            ],

            [
                'country_id.required' => 'Pasirinkite Šalį',
                'name.required' => 'Neteisingas kategorijos pavadinimas',
                'longitude.required' => 'Laukelis privalomas',
                'latitude.required' => 'Laukelis privalomas',
            ]
        );


        $airport = Airport::find($id);
        $airport->name = $request->name;
        $airport->country_id = $request->country_id;

        $airport->longitude = $request->longitude;
        $airport->latitude = $request->latitude;

        $airport->save();
        $airlinesIds = $request->input('airlines');
        $airport->airline()->detach();
        if (!is_null($airlinesIds)) {

            for ($i = 0; $i < count($airlinesIds); $i++) {
                $airport->airline()->attach($airlinesIds[$i]);
            }
        }


        session()->flash('success', 'Oro uostas atnaujintas');
        return redirect()->route('index');
    }

    public function destroy($id)
    {
        $airport = Airport::find($id);
        if (!is_null($airport)) {
            $airport->airline()->detach();
            $airport->delete();
        }
        session()->flash('success', 'Brand ištrinta sėkmingai!');
        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
}
