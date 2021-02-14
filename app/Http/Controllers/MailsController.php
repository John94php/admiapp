<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Mails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MailsController extends Controller
{
    public function index() {
        $user_id = Auth::user()->id;
        $inbox = DB::table('mails')->where('mail_folder','=','inbox',)->where('user_id','=',$user_id)->get();
        $sent = DB::table('mails')->where('mail_folder','=','sent')->where('user_id','=',$user_id)->get();
        $drafts = DB::table('mails')->where('mail_folder','=','drafts')->where('user_id','=',$user_id)->get();
        $trash = DB::table('mails')->where('mail_folder','=','trash')->where('user_id','=',$user_id)->get();
        $form = "test";
        $configuration = DB::table('config')->where('user_id','=',$user_id);
        return view('mails.index',['inbox'=>$inbox,'sent'=>$sent,'drafts'=>$drafts,'trash'=>$trash,'form'=>$form,'configuration'=>$configuration]);
    }

    public function show($id) {
        $user_id = Auth::user()->id;

        $change = DB::table('mails')->where('mail_id','=',$id)->update(['mail_status'=>'seen']);
        $show = DB::table('mails')->where('mail_id','=',$id)->get();
        $showcog = DB::table('config')->where('user_id','=',$user_id)->get();
        return view('mails.showMail',['show'=>$show,'showcog'=>$showcog]);
    }
    public function create() {
        $users = DB::select('SELECT name,email FROM users');
        return view('mails.createMail',['users'=>$users]);
    }
    public function store() {

    }
    public function moveToTrash($id) {
        DB::update('UPDATE mails SET mail_folder="trash" WHERE mail_id = ?',[$id]);
        return redirect()->action([MailsController::class, 'index'])->with('success','Message deleted successfully');
    }
    public function restore($id) {
        DB::update('UPDATE mails SET mail_folder="inbox" WHERE mail_id = ?',[$id]);
        return redirect()->action([MailsController::class, 'index'])->with('success','Message restored successfully');

    }
    public function destroy(Request $request) {

    }
}
