<?php

namespace App\Http\Controllers;

use App\Models\Agent_user;
use App\Models\Location;
use App\Models\Van_selling_calls;
use Illuminate\Http\Request;

class Van_selling_unproductive_calls_controller extends Controller
{
    public function index()
    {
        $agent_user = Agent_user::first();
        $location = Location::first();
        if (empty($agent_user)) {
            return redirect('agent_user');
        } else if (empty($location)) {
            return redirect('location');
        } else {
            $calls = Van_selling_calls::where('status', null)->get();
            date_default_timezone_set('Asia/Manila');
            $date = date('Y-m-d');
            $time = date('His');
            return view('van_selling_unproductive_calls_export', [
                'calls' => $calls,
                'date' => $date,
                'time' => $time,
            ])->with('active', 'van_selling_unproductive_calls_export')
                ->with('agent_user', $agent_user);
        }
    }

    public function van_selling_export_productive_calls_update_status(Request $request)
    {
        if (is_null($request->input('id'))) {
            return redirect('van_selling_transaction');
        } else {
            foreach ($request->input('id') as $key => $data) {
                Van_selling_calls::where('id', $data)
                    ->update(['status' => 'exported']);
            }
        }
        return redirect('van_selling_transaction');
    }
}
