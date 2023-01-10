<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Model\Chat_room;
use App\Model\Chat_message;
use App\Model\Permission;
use Illuminate\Validation\Rule;
use Auth;
use Validator;
use DB;
    
class ChatController extends Controller
{
    public function __construct(Permission $permission)
    {
        $this->middleware('superadmin');
        $this->middleware('view_chat')->only('index');
        $this->Permission = $permission;
    }

    
    public function index() {
        $user_list = User::all();
        $getPermission = $this->Permission->getPermission();
        return view('admin.chat.list', compact('user_list', 'getPermission'));
    }

    public function send(Request $request, Chat_message $cm){
        $data = $request->all();
        $cm->create($data);
    }

    // public function get_another_user($user_id){
    //     $list = DB::table('chat_rooms')
    //     ->join('users', 'users.id', '=', 'chat_rooms.another_user_id')
    //     ->where('chat_rooms.user_id', '=', $user_id)
    //     ->selectRaw('users.first_name, users.last_name, chat_rooms.another_user_id')->get();

    //     $data = '';
    //     if(count($list) > 0){
    //         foreach ($list as $key) {
    //             $data .= "<option value=".$key->another_user_id.">".ucwords($key->first_name.' '.$key->last_name)."</option>";
    //         }
    //     }
    //     else{
    //         $list = DB::table('chat_rooms')
    //         ->join('users', 'users.id', '=', 'chat_rooms.user_id')
    //         ->where('chat_rooms.another_user_id', '=', $user_id)
    //         ->selectRaw('users.first_name, users.last_name, chat_rooms.user_id')->get();
            
    //         if(count($list) > 0){
    //             foreach ($list as $key) {
    //                 $data .= "<option value=".$key->user_id.">".ucwords($key->first_name.' '.$key->last_name)."</option>";
    //             }
    //         }
    //         else{
    //             $data .= "<option value=''>No User Found</option>";
    //         }
    //     }
    //     return $data;
    // }

    public function getmsgs($user_id, $another_user_id)
    {
        $room = Chat_room::where('user_id', $user_id)
        ->where('another_user_id', $another_user_id)->first();

        if($room['id']){
            $room_id = $room['id'];
        }
        else{
            $room = Chat_room::where('user_id', $another_user_id)
            ->where('another_user_id', $user_id)->first();
            $room_id = $room['id'];
        }

        //echo $room_id;exit;
        if($room_id){
            $msgs = Chat_message::where('room_id', $room_id)->get();
            $data = '';
            foreach ($msgs as $row) {
                if($row->user_id == $user_id){
                    $data .= "<div class='msgRow'>
                                <p class='right-msg'><span>".$row->message."</span></p>
                            </div>";
                }
                else{
                    $data .= "<div class='msgRow'>
                                <p class='left-msg'><span>".$row->message."</span></p>
                            </div>";
                }            
            }
        }
        else
        $data = "No Message Found.";
        return array('msgs' => $data, 'room_id' => $room_id, 'user_id' => $user_id);        
    }

    //delete
    // public function destroy($id)
    // {
    //     $attr = Chat_message::find($id);        
    //     $attr->delete();
    //     return redirect()->route('attribute.index')->withSuccess('Attribute delete successfully');
    // }
}
