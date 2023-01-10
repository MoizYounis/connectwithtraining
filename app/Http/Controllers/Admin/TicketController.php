<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Ticket;
use App\Model\Ticket_reply;
use App\Model\Permission;
use Illuminate\Validation\Rule;
use Auth;
use Validator;
use DB;
    
class TicketController extends Controller
{
    public function __construct(Permission $permission)
    {
        $this->middleware('superadmin');
        $this->Permission = $permission;
    }

    public function index() {
        $ticket_list = Ticket::join('users', 'users.id', '=', 'tickets.user_id')
        ->selectRaw('tickets.*, users.first_name, users.last_name')->get();
        $getPermission = $this->Permission->getPermission();
        return view('admin.tickets.list', compact('ticket_list', 'getPermission'));
    }

    public function reply($id){
        $ticket = Ticket::join('users', 'users.id', '=', 'tickets.user_id')
        ->where('tickets.id', $id)
        ->selectRaw('tickets.user_id, tickets.ticket_title, tickets.ticket_details, tickets.created_at, tickets.id, users.email, users.image')->first();

        $reply_list = DB::table('ticket_reply as tr')
            ->join('tickets', 'tr.ticket_id', '=', 'tickets.id')
            ->select('tr.reply', 'tr.created_at', 'tr.user_id', 'tr.ticket_id')->orderBy('tr.id', 'DESC')->get();

        $getPermission = $this->Permission->getPermission();
        return view('admin.tickets.reply', compact('getPermission', 'ticket', 'reply_list'));   
    }

    public function update_status(Request $request) {
        $data = $request->all();
        $ticket = Ticket::find($data['id']);
        $ticket->update($data);
    }

    public function sendReply(Request $request, Ticket_reply $tr){
        $data = $request->all();
        $tr->create($data);
        return redirect()->back()->withSuccess("Message sent successfully");
    }

    //delete
    public function destroy($id)
    {
        $ticket = Ticket::find($id);        
        $ticket->delete();
        return redirect()->back()->withSuccess("Deleted successfully");
    }
}
