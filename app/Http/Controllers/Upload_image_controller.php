<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Sales_order;
use App\Models\Customer;
use App\Models\Collection_image;
use Illuminate\Http\Request;

class Upload_image_controller extends Controller
{
    public function index()
    {
    	$agent = User::find(auth()->user()->id);
    	$customer = Customer::select('store_name','id')->get();
    	$collection_image = Collection_image::get();
    	return view('upload_image',[
    		'customer' => $customer,
    		'collection_image' => $collection_image,
    	])->with('active','upload_image')
    		->with('agent', $agent);
    }

    public function upload_image_save(Request $request)
    {
    	$request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $image_name = time().'.'.$request->image->extension();  
   
        $request->image->move(public_path('images'), $image_name);

        $upload = new Collection_image([
        	'customer_id' => $request->input('customer_id'),
        	'image' => $image_name,
        ]);
   		
   		$upload->save();
        return redirect('upload_image');

        // if ($upload_image) {
        //       Session::flash('success');
        //       return redirect('received_invoice');
        // }else{
        //       Session::flash('error');
        //       return redirect('received_invoice');
        // }

    }
}
