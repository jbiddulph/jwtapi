<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use App\Http\Resources\VenueResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $venues = Venue::where('postcode', '=', 'BN11 3ED')
        $venues = Venue::has('events') // get venues that have data in their EVENTS 
        ->with('events') // eager loads events relation
        ->simplePaginate(50);
        return VenueResource::collection($venues);
    }

    /**
     * Search for a name.
     *
     * @param  str  $name
     * @return \Illuminate\Http\Response
     */
    public function search($postcode)
    {  
        return Venue::where('postcode', 'like', '%'.$postcode.'%')->limit(250)->get();
        // return VenueResource::make(Venue::where('postcode', 'like', '%'.$postcode.'%')->limit(250)->get());
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPostCodes()
    {
        $postcodes = DB::table('venues')->distinct()->get(['postcode']);
        return $postcodes;
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return Venue::where('id', $id)->get();
        return VenueResource::make(Venue::find($id));
    }
    

    /**
     * Display a listing of the resource.
     *
     * @param  string  $town
     * @return \Illuminate\Http\Response
     */
    public function getTownVenues($town)
    {
        $towns = Venue::where('town', $town)
        ->has('events') // get venues that have data in their EVENTS 
        ->with('events') // eager loads events relation
        ->simplePaginate(100);
        return VenueResource::collection($towns);
        
        // return Venue::where('town', $town)->get();
        
    }

    /**
     * Display a listing of the resource.
     *
     * @param  string  $town
     * @return \Illuminate\Http\Response
     */
    public function getTowns()
    {
        $towns = Venue::has('events') // get venues that have data in their EVENTS 
        ->distinct()
        ->get(['town']);
        return $towns;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'venuename'=>'required',
        ]);
        // return Venue::create($request->all());
        return VenueResource::make(Venue::create($request->all()));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $venue = Venue::find($id);

        $venue->update($request->all());

        return VenueResource::make($venue);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Venue::destroy($id);
    }
}
