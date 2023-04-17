<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Collection;
use App\Models\Collection_image;
use Illuminate\Http\Request;

class Collection_upload_image_controller extends Controller
{
    public function index()
    {
    	$agent = User::find(auth()->user()->id);
    	$collection = Collection::select('id','total_amount_collected','customer_id','date_collected')->where('status', '!=', 'UPLOADED')->get();
    	return view('collection_upload_image')
    		->with('active','collection_upload_image')
    		->with('agent', $agent)
    		->with('collection',$collection);    
    }

    public function collection_upload_image_proceed(Request $request)
    {
        $collection = Collection::find($request->input('collection_id'));

        return view('collection_upload_image_proceed_page',[
            'collection' => $collection,
        ]);
    }

    public function collection_upload_image_proceed_to_final_summary(Request $request)
    {

    	//return $request->input();
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d');
        $date_name = date('Ymd');
        $time = date('His');

    	$this->validate($request, [
            'images' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'

        ]);
        
        $input=$request->all();
		$images=array();

		    if($files=$request->file('images')){
		        foreach($files as $file){
		            $name=$file->getClientOriginalName();
		            $file->move('images',$name);
		            $images[]=$name;
		        }
		    }

        
        foreach ($images as $key => $data) {
            $collection_image = new Collection_image([
                    'collection_id' => $request->input('collection_id'),
                    'image' => $data,
            ]);

            $collection_image->save();
        }

        Collection::where('id', $request->input('collection_id'))
          ->update(['status' => 'UPLOADED']);

        return 'saved';
    }
}
