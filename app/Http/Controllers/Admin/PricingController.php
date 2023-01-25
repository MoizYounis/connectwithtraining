<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Permission;
use App\Model\Pricing;
use Auth;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    public function __construct(Permission $permission)
    {
        $this->middleware('superadmin');
        $this->middleware('create_pricing')->only(['create', 'store']);
        $this->middleware('view_pricing')->only('index');
        $this->middleware('update_pricing')->only(['edit', 'update']);
        $this->middleware('delete_pricing')->only('destroy');
        $this->Permission = $permission;
    }

    //sub Pricing list
    public function index()
    {
        $query = Pricing::query();
        $query->orderBy('pricing_name');
        if (Auth::user()->userType != "superadmin") {
            $query->where('user_id', Auth::user()->id);
        }
        $pricing_list = $query->get();
        $getPermission = $this->Permission->getPermission();
        return view('admin.pricing.pricing_list', compact('pricing_list', 'getPermission'));
    }

    // public function create() {
    //     return view('admin.blog.add_blog', compact('pricing_list', 'user_list'));
    // }

    public function store(Request $request, Pricing $pricing)
    {
        $request->validate([
            'pricing_name' => 'required|unique:pricings,pricing_name',
            'pricing_type' => 'required',
            'price' => 'required',
            'expiry_days' => 'required',
            'courses' => 'required',
            'certificates' => 'required',
            'badges' => 'required',
            'days' => 'required',
        ]);

        $single_1 = Pricing::where('pricing_type', $request->pricing_type)->first();
        if (!empty($single_1)) {
            return redirect()->back()->withErrors("SINGLE / FREE Type Already Exists!");
        }

        $single_2 = Pricing::where('pricing_type', $request->pricing_type)->first();
        if (!empty($single_2)) {
            return redirect()->back()->withErrors("SINGLE / NO DELAY INTERVIEW Type Already Exists!");
        }

        $corporate = Pricing::where('pricing_type', $request->pricing_type)->first();
        if (!empty($corporate)) {
            return redirect()->back()->withErrors("CORPORATE Type Already Exists!");
        }

        $enterprise = Pricing::where('pricing_type', $request->pricing_type)->first();
        if (!empty($enterprise)) {
            return redirect()->back()->withErrors("ENTERPRISE Type Already Exists!");
        }

        $single_3 = Pricing::where('pricing_type', $request->pricing_type)->first();
        if (!empty($single_3)) {
            return redirect()->back()->withErrors("SINGLE / TAILORED INTERVIEW Type Already Exists!");
        }

        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $pricing->create($data);
        return back()->withSuccess('Pricing created successfully');
    }

    //update
    public function update(Request $request, $pricing_id)
    {
        $request->validate([
            'pricing_name' => 'required',
            'pricing_type' => 'required',
            'price' => 'required',
            'expiry_days' => 'required',
            'courses' => 'required',
            'certificates' => 'required',
            'badges' => 'required',
            'days' => 'required',
        ]);

        $name_single_1 = Pricing::where('pricing_name', $request->pricing_name)->where('id', '!=', $pricing_id)->first();
        if (!empty($name_single_1)) {
            return redirect()->back()->withErrors("SINGLE / FREE Name Already Exists!");
        }

        $name_single_2 = Pricing::where('pricing_name', $request->pricing_name)->where('id', '!=', $pricing_id)->first();
        if (!empty($name_single_2)) {
            return redirect()->back()->withErrors("SINGLE / NO DELAY INTERVIEW Name Already Exists!");
        }

        $name_corporate = Pricing::where('pricing_name', $request->pricing_name)->where('id', '!=', $pricing_id)->first();
        if (!empty($name_corporate)) {
            return redirect()->back()->withErrors("CORPORATE Name Already Exists!");
        }

        $name_enterprise = Pricing::where('pricing_name', $request->pricing_name)->where('id', '!=', $pricing_id)->first();
        if (!empty($name_enterprise)) {
            return redirect()->back()->withErrors("ENTERPRISE Name Already Exists!");
        }

        $name_single_3 = Pricing::where('pricing_name', $request->pricing_name)->where('id', '!=', $pricing_id)->first();
        if (!empty($name_single_3)) {
            return redirect()->back()->withErrors("SINGLE / TAILORED INTERVIEW Name Already Exists!");
        }

        $single_1 = Pricing::where('pricing_type', $request->pricing_type)->where('id', '!=', $pricing_id)->first();
        if (!empty($single_1)) {
            return redirect()->back()->withErrors("SINGLE / FREE Type Already Exists!");
        }

        $single_2 = Pricing::where('pricing_type', $request->pricing_type)->where('id', '!=', $pricing_id)->first();
        if (!empty($single_2)) {
            return redirect()->back()->withErrors("SINGLE / NO DELAY INTERVIEW Type Already Exists!");
        }

        $corporate = Pricing::where('pricing_type', $request->pricing_type)->where('id', '!=', $pricing_id)->first();
        if (!empty($corporate)) {
            return redirect()->back()->withErrors("CORPORATE Type Already Exists!");
        }

        $enterprise = Pricing::where('pricing_type', $request->pricing_type)->where('id', '!=', $pricing_id)->first();
        if (!empty($enterprise)) {
            return redirect()->back()->withErrors("ENTERPRISE Type Already Exists!");
        }

        $single_3 = Pricing::where('pricing_type', $request->pricing_type)->where('id', '!=', $pricing_id)->first();
        if (!empty($single_3)) {
            return redirect()->back()->withErrors("SINGLE / TAILORED INTERVIEW Type Already Exists!");
        }

        $pricing = Pricing::find($pricing_id);
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $pricing->update($data);
        return redirect()->route('pricing.index')->withSuccess("Pricing updated successfully");
    }

    //delete
    public function destroy($pricing_id)
    {
        //delete image
        $pricing = Pricing::find($pricing_id);
        $pricing->delete();
        return redirect()->route('pricing.index')->withSuccess("Pricing deleted successfully");
    }
}
