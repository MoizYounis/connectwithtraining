<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Validation\Rule;
use Validator;
use Hash;
use Illuminate\Support\Facades\Input;
use Session;
use Excel;

class ImportController extends Controller
{    
	public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function test(){
        return view('admin.import.import');
    }

    function import(Request $request)
    {
        $this->validate($request, [
            'import'  => 'required|mimes:xls,xlsx'
        ]);

        $path = $request->file('import')->getRealPath();

        $data = Excel::load($path)->get();

        if($data->count() > 0)
        {

            foreach($data->toArray() as $key => $value)
            {
                //
                foreach($value as $row)
                {
                    print_r($row['name']);exit;
                    // echo "<br>";
                    $insert_data[] = array(
                        'name'   => $row['name'],
                        'city'  => $row['city'],
                    );
                }
            }

            if(!empty($insert_data))
            {
                DB::table('test_import')->insert($insert_data);
            }
        }
        return back()->with('success', 'Excel Data Imported successfully.');
    }
}
