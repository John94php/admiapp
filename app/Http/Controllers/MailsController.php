<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Mails;
use Illuminate\Support\Facades\DB;

class MailsController extends Controller
{
    public function index() {
        $inbox = DB::table('mails')->where('mail_folder','=','inbox')->get();
        $sent = DB::table('mails')->where('mail_folder','=','sent')->get();
        $drafts = DB::table('mails')->where('mail_folder','=','drafts')->get();
        $trash = DB::table('mails')->where('mail_folder','=','trash')->get();
        $form = "test";
        return view('mails.index',['inbox'=>$inbox,'sent'=>$sent,'drafts'=>$drafts,'trash'=>$trash,'form'=>$form]);
    }

    public function show($id) {
        $change = DB::table('mails')->where('mail_id','=',$id)->update(['mail_status'=>'seen']);
        $show = DB::table('mails')->where('mail_id','=',$id)->get();
        return view('mails.showMail',compact('show'));
    }
    public function create() {
        $users = DB::select('SELECT name,email FROM users');
        return view('mails.createMail',['users'=>$users]);
    }
    public function store() {

    }
    public function delete() {

    }
}
