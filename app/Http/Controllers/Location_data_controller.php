<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Location;

use Illuminate\Http\Request;

class Location_data_controller extends Controller
{
    public function index()
    {
    	$location = Location::get();
   	 	$location_counter = count($location);
   	 	$agent = User::find(auth()->user()->id);
    	return view('location_data')->with('active','location')
    		->with('agent', $agent)
    		->with('location_counter', $location_counter)
    		->with('location', $location);
    }
}
