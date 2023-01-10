<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Menu;
use App\Model\Permission;
use Illuminate\Validation\Rule;
use Auth;
use Validator;
use DB;
    
class MenuController extends Controller
{
    public function __construct(Permission $permission)
    {
        $this->middleware('superadmin');
        $this->middleware('create_menu')->only(['create', 'store']);
        $this->middleware('view_menu')->only('index');
        $this->middleware('update_menu')->only(['edit', 'update']);
        $this->middleware('delete_menu')->only('destroy');
        $this->Permission = $permission;
    }

    public function index() {
        $menu_list = Menu::orderBy('menu_name')->get();
        $getPermission = $this->Permission->getPermission();
        return view('admin.menu.list', compact('menu_list', 'getPermission'));
    }

    public function create() {
        $getPermission = $this->Permission->getPermission();
        return view('admin.menu.add', compact('getPermission'));
    }

    public function store(Request $request, Menu $menu) {
        $request->validate([
            'menu_name' => 'required',
            'menu_url' => 'required',
        ]);
        $data = $request->all();
        if ($request->get('menu_status')) {
            $data['menu_status'] = "Publish";
        }
        else {
            $data += ["menu_status" => "Unpublished"];
        }
        $menu->create($data);
        return back()->withSuccess('Menu created successfully');
    }

    public function edit($menu_id){
        $menu_edit = Menu::find($menu_id);
        $getPermission = $this->Permission->getPermission();
        return view('admin.menu.edit', compact('menu_edit', 'getPermission'));
    }

    //update
    public function update(Request $request, $menu_id){
        $request->validate([
            'menu_name' => 'required',
            'menu_url' => 'required',
        ]);

        $menu = Menu::find($menu_id);
        $data = $request->all();
        if ($request->get('menu_status')) {
            $data['menu_status'] = "Publish";
        }
        else {
            $data += ["menu_status" => "Unpublished"];
        }
        $menu->update($data);
        return redirect()->route('menu.index')->withSuccess("Menu updated successfully");
    }

    //delete
    public function destroy($menu_id)
    {
        $menu = Menu::find($menu_id);        
        $menu->delete();
        return redirect()->route('menu.index')->withSuccess("Menu deleted successfully");
    }
}
