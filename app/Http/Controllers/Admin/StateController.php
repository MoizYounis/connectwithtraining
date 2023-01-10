<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\State;
use Auth;
use Validator;
use DB;
use Session;

class StateController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function state_list(Request $request){
    	$state_list = State::all()->sortBy("state_name");
    	return view('admin.state.state_list', compact('state_list'));
    }

	public function add_state(){
    	return view('admin.state.add_state');
    }

    public function create_state(Request $request, State $state) {
        $request->validate([
            'state_name' => 'required',
        ]);
        $data = $request->all();
        //print_r($data);exit;

        if ($request->get('state_status')) {
            $data['state_status'] = "Active";
        }
        else {
            $data += ["state_status" => "Inactive"];
        }

       	$state->create($data);

        return back()->withSuccess('State created successfully');
    }

    //edit state
    public function edit_state($state_id){
        $state_edit = State::where('state_id', '=', $state_id)
        ->get();
        return view('admin.state.edit_state', compact('state_edit'));
    }

    //update
    public function update_state(Request $request, State $state, $state_id){
        $request->validate([
            'state_name' => 'required',            
        ]);

        $state = State::find($state_id);
        $data = $request->all();

        if ($request->get('state_status')) {
            $data['state_status'] = "Active";
        } else {
            $data += ["state_status" => "Inactive"];
        }
        
        $state->update($data);
        return redirect()->route('state_list')->withSuccess("State information updated successfully");
    }

    //delete
    public function destroy($state_id)
    {
        $state = State::find($state_id);
        $state->delete();
        return redirect()->route('state_list');
    }
}
