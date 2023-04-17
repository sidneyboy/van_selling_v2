<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Principal;
use Illuminate\Http\Request;

class Principal_data_controller extends Controller
{
    public function index()
    {
    	
    	$principal = Principal::get();
    	$principal_counter = count($principal);
    	$agent = User::find(auth()->user()->id);
    	return view('principal_data')
    		->with('active','principal')
    		->with('agent', $agent)
    		->with('principal', $principal)
    		->with('principal_counter', $principal_counter);
    }
}
