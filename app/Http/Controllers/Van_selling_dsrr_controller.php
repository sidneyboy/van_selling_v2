<?php

namespace App\Http\Controllers;
use App\Models\Van_selling_transaction;
use App\Models\Van_selling_transaction_details;
use App\Models\Van_selling_upload_ledger;
use App\Models\Agent_user;
use App\Models\Principal;
use DB;
use Illuminate\Http\Request;

class Van_selling_dsrr_controller extends Controller
{
    public function index()
    {
       
    	$agent_user = Agent_user::first();
        return view('Van_selling_dsrr')
            ->with('active','van_selling_dsrr')
            ->with('agent_user',$agent_user);
    }

    public function van_selling_dsrr_generate_principal(Request $request)
    {
       // return $request->input();
        $var = explode('-', $request->input('reservation'));
        $date_from = date('Y-m-d',strtotime($var[0]));
        $date_to = date('Y-m-d',strtotime($var[1]));
        $time = date('His');

        $van_selling_transaction = Van_selling_transaction::select('id')->where('status','!=','CANCELLED')->whereBetween('date',[$date_from,$date_to])->get();

        if (count($van_selling_transaction) != 0) {
            foreach ($van_selling_transaction as $key => $data) {
                $id[] = $data->id;
            }

            $principal = Van_selling_transaction_details::select('principal')->whereIn('van_selling_trans_id',$id)->groupBy('principal')->get();

            return view('van_selling_dsrr_generate_principal_page',[
                'principal' => $principal,
            ]);
        }else{
            return 'NO_DATA_FOUND';
        }
    }

    public function van_selling_dsrr_generate_data(Request $request)
    {
    	//return $request->input();
    	$var = explode('-', $request->input('date_range'));
        $date_from = date('Y-m-d',strtotime($var[0]));
        $date_to = date('Y-m-d',strtotime($var[1]));
        $time = date('His');

        if ($request->input('search_for') == 'dsrr') {
            $van_selling_transaction = Van_selling_transaction::whereBetween('date',[$date_from,$date_to])->where('status','!=','CANCELLED')->get();
            $counter = count($van_selling_transaction);

            if($counter != 0){
                 return view('van_selling_dsrr_generate_page',[
                            'van_selling_transaction' => $van_selling_transaction,
                    ])->with('date_from',$date_from)
                      ->with('date_to',$date_to)
                      ->with('time',$time)
                      ->with('full_name',$request->input('full_name'))
                      ->with('user_id',$request->input('user_id'))
                      ->with('search_for',$request->input('search_for'));
            }else{
                    return 'NO_DATA_FOUND';
            }
        }else if($request->input('search_for') == 'all_principal'){
            $van_selling_transaction = Van_selling_transaction::select('id','store_name','full_address')->where('status','!=','CANCELLED')->whereBetween('date',[$date_from,$date_to])->get();

             return view('van_selling_dsrr_generate_page',[
                            'van_selling_transaction' => $van_selling_transaction,
                    ])->with('date_from',$date_from)
                      ->with('date_to',$date_to)
                      ->with('time',$time)
                      ->with('full_name',$request->input('full_name'))
                      ->with('user_id',$request->input('user_id'))
                      ->with('search_for',$request->input('search_for'));
        }else{
            $van_selling_transaction = Van_selling_transaction::select('id')->where('status','!=','CANCELLED')->whereBetween('date',[$date_from,$date_to])->get();

            foreach ($van_selling_transaction as $key => $data) {
                $id[] = $data->id;
            }

            $van_selling_transaction_details = Van_selling_transaction_details::select('description','quantity','price','van_selling_trans_id')->whereIn('van_selling_trans_id',$id)->where('principal',$request->input('search_for'))->get();

            return view('van_selling_dsrr_generate_page',[
                            'van_selling_transaction_details' => $van_selling_transaction_details,
                    ])->with('date_from',$date_from)
                      ->with('date_to',$date_to)
                      ->with('time',$time)
                      ->with('full_name',$request->input('full_name'))
                      ->with('user_id',$request->input('user_id'))
                      ->with('search_for',$request->input('search_for'));
        }
       
    }
}
