<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use App\Models\Airport;
use Illuminate\Http\Request;
use App\Models\Country;

class AirlineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $airlines = Airline::latest()->paginate(10);
        // dd($airlines);
        return view('airlinesindex')->with('airlines', $airlines);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countrys = Country::orderBy('name', 'desc')->get();
        return view('airlinescreate', compact('countrys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate(
            $request,
            [
                'country_id' => 'required|numeric',
                'name' => 'required|string',

            ],

            [
                'country_id.required' => 'Pasirinkite Šalį',
                'name.required' => 'Neteisingas pavadinimas',
            ]
        );

        $airline = new Airline();
        $airline->country_id = $request->country_id;
        $airline->name = $request->name;
        $airline->save();
        // dd($airport);
        return redirect()->route('airlines.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Airline  $airline
     * @return \Illuminate\Http\Response
     */
    public function show(Airline $airline)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Airline  $airline
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $airline = Airline::find($id);
        $countrys = Country::orderBy('name', 'desc')->get();
        if (!is_null($airline)) {
            return view('airlinesedit', compact('airline', 'countrys'));
        } else {
            return redirect()->route('index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Airline  $airline
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'country_id' => 'required|numeric',
                'name' => 'required|string',

            ],

            [
                'country_id.required' => 'Pasirinkite Šalį',
                'name.required' => 'Neteisingas pavadinimas',
            ]
        );

        $airline = Airline::find($id);
        $airline->name = $request->name;
        $airline->country_id = $request->country_id;

        $airline->save();
        return redirect()->route('airlines.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Airline  $airline
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $airlines = Airline::latest()->paginate(10);
        $airline = Airline::find($id);
        if (!is_null($airline)) {
            $airline->airports()->detach();
            $airline->delete();
        }
        return redirect()->route('airlines.index');
        return view('airlinesindex')->with('airlines', $airlines);;
    }
}
