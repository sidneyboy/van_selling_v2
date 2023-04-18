<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Agent_user;
use App\Models\Vs_os;
use Illuminate\Http\Request;

class Van_selling_os_transaction_controller extends Controller
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
            $os = Vs_os::select('os_code', 'store_name', 'date')->groupBy('os_code')->orderBy('id', 'desc')->get();
            return view('van_selling_os_transaction', [
                'os' => $os,
            ])->with('active', 'van_selling_os_transaction')
                ->with('agent_user', $agent_user);
        }
    }

    public function van_selling_os_transaction_proceed(Request $request)
    {
        $os = Vs_os::where('os_code', $request->input('os_code'))->get();

        return view('van_selling_os_transaction_proceed', [
            'os' => $os,
        ]);
    }
}
