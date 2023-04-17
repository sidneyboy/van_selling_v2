<?php

namespace App\Http\Controllers;
use App\Models\Sku_inventory;
use App\Models\User;
use Illuminate\Http\Request;

class Sku_inventory_data_controller extends Controller
{
    public function index()
    {

	     $agent = User::find(auth()->user()->id);
	   	 $sku_inventory = Sku_inventory::get();
	   	 $sku_counter = count($sku_inventory);
	   	 return view('sku_inventory_data',[
	   	 		'sku_inventory' => $sku_inventory,
	   	 	])
	   	 		->with('active','sku_inventory')
	   	 		->with('agent',$agent)
	   	 		->with('sku_counter',$sku_counter);
    }
}
