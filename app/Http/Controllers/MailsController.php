<?php

namespace App\Http\Controllers;
session_start();


use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Mails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Input\Input;


class MailsController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        $mysteryfold = DB::table('config')->select('folders')->where('us_id','=',$user_id)->get();
         $inbox = DB::table('mails')->where('mail_folder', '=', 'inbox',)->where('user_id', '=', $user_id)->get();
        $sent = DB::table('mails')->where('mail_folder', '=', 'sent')->where('user_id', '=', $user_id)->get();
        $drafts = DB::table('mails')->where('mail_folder', '=', 'drafts')->where('user_id', '=', $user_id)->get();
        $trash = DB::table('mails')->where('mail_folder', '=', 'trash')->where('user_id', '=', $user_id)->get();
        $configuration = DB::table('config')->join('users','users.id','=','config.us_id')->where('users.id', '=', $user_id)->get();
        return view('mails.index', ['inbox' => $inbox, 'sent' => $sent, 'drafts' => $drafts, 'trash' => $trash,  'configuration' => $configuration,'mysteryfold'=>$mysteryfold]);
    }

    public function show($id)
    {
        $user_id = Auth::user()->id;

        $change = DB::table('mails')->where('mail_id', '=', $id)->update(['mail_status' => 'seen']);
        $show = DB::table('mails')->where('mail_id', '=', $id)->get();
        $showcog = DB::table('config')->join('mails','mails.user_id','=','config.us_id')->where('user_id', '=', $user_id)->get();

        return view('mails.showMail', ['show' => $show, 'showcog' => $showcog]);
    }

    public function create()
    {
        $name = Auth::user()->name;
        $email = Auth::user()->email;
        $users = DB::select('SELECT name,email FROM users WHERE name != ? AND email !=?',[$name,$email]);
        return view('mails.createMail', ['users' => $users]);
    }

    public function store(Request $request)
    {
        $user_id = Auth::id();
        $user_mail = Auth::user()->email;
        $mail_sender = $request->input('mail_sender');
        $mail_recipient = $request->input('mail_recipient');
        $mail_title = $request->input('mail_title');
        $dw = $request->input('mail_dw');
        $udw = $request->input('mail_udw');
        $mail_body = $request->input('mail_body');
        $created_at = date('Y-m-d H:i:s');
        $recipient_id = DB::table('users')->select('id')->where('email','=',$mail_recipient)->get();
        foreach($recipient_id as $rid) {
         $recipientid = $rid->id;
        }
        $udw_id = DB::table('users')->select('id')->where('email','=',$udw)->get();
        $dw_id = DB::table('users')->select('id')->where('email','=',$dw)->get();
        foreach($dw_id as $did) {
            $dwid = $did->id;
        }
        foreach($udw_id as $udid) {
            $udwid = $udid->id;
        }


        if($_POST["mail_dw"]) {
            DB::table('mails')->insert([
                'mail_sender' => $mail_sender,
                'mail_recipient' => $mail_recipient,
                'mail_title' => $mail_title,
                'mail_body' => $mail_body,
                'mail_dw' => $dw,
                'mail_udw' => $udw,
                'mail_folder' => "sent",
                'mail_status' => "seen",
                'created_at' => $created_at,
                'user_id' => $user_id

            ]);

            DB::table('mails')->insert([
                'mail_sender' => $mail_sender,
                'mail_recipient' => $mail_recipient,
                'mail_title' => $mail_title,
                'mail_body' => $mail_body,
                'mail_dw' => $dw,
                'mail_udw' => $udw,
                'mail_folder' => "inbox",
                'mail_status' => "unseen",
                'created_at' => $created_at,
                'user_id' => $recipientid

            ]);
            DB::table('mails')->insert([
                'mail_sender' => $mail_sender,
                'mail_recipient' => $mail_recipient,
                'mail_title' => $mail_title,
                'mail_body' => $mail_body,
                'mail_dw' => $dw,
                'mail_udw' => $udw,
                'mail_folder' => "inbox",
                'mail_status' => "unseen",
                'created_at' => $created_at,
                'user_id' => $dwid

            ]);

        }
        else if($_POST["mail_udw"]) {
            DB::table('mails')->insert([
                'mail_sender' => $mail_sender,
                'mail_recipient' =>$mail_recipient,
                'mail_title' =>$mail_title,
                'mail_body' =>$mail_body,
                'mail_dw' =>$dw,
                'mail_udw' =>$udw,
                'mail_folder' =>"sent",
                'mail_status' =>"seen",
                'created_at' =>$created_at,
                'user_id' => $user_id

            ]);
            DB::table('mails')->insert([
                'mail_sender' => $mail_sender,
                'mail_recipient' =>$mail_recipient,
                'mail_title' =>$mail_title,
                'mail_body' =>$mail_body,
                'mail_dw' =>$dw,
                'mail_udw' =>$udw,
                'mail_folder' =>"inbox",
                'mail_status' =>"unseen",
                'created_at' =>$created_at,
                'user_id' => $recipientid
            ]);
            DB::table('mails')->insert([
                'mail_sender' => $mail_sender,
                'mail_recipient' =>$mail_recipient,
                'mail_title' =>$mail_title,
                'mail_body' =>$mail_body,
                'mail_dw' =>$dw,
                'mail_udw' =>$udw,
                'mail_folder' =>"inbox",
                'mail_status' =>"unseen",
                'created_at' =>$created_at,
                'user_id' => $dwid

            ]);
            DB::table('mails')->insert([
                'mail_sender' => $mail_sender,
                'mail_recipient' =>$mail_recipient,
                'mail_title' =>$mail_title,
                'mail_body' =>$mail_body,
                'mail_dw' =>$dw,
                'mail_udw' =>$udw,
                'mail_folder' =>"inbox",
                'mail_status' =>"unseen",
                'created_at' =>$created_at,
                'user_id' => $udwid

            ]);
        }
        else {
            DB::table('mails')->insert([
                'mail_sender' => $mail_sender,
                'mail_recipient' =>$mail_recipient,
                'mail_title' =>$mail_title,
                'mail_body' =>$mail_body,
                'mail_dw' =>null,
                'mail_udw' =>null,
                'mail_folder' =>"sent",
                'mail_status' =>"seen",
                'created_at' =>$created_at,
                'user_id' => $user_id

            ]);
            DB::table('mails')->insert([
                'mail_sender' => $mail_sender,
                'mail_recipient' =>$mail_recipient,
                'mail_title' =>$mail_title,
                'mail_body' =>$mail_body,
                'mail_dw' =>null,
                'mail_udw' =>null,
                'mail_folder' =>"inbox",
                'mail_status' =>"unseen",
                'created_at' =>$created_at,
                'user_id' => $recipientid

            ]);
        }
        return redirect()->action([MailsController::class, 'index'])->with('success', 'Message sent successfully');

    }
public function reply(Request $request) {
        $mail_sender = $request->input('mail_sender');
        $mail_recipient = $request->input('mail_recipient');
        $mail_title = $request->input('mail_title');
        $mail_body = $request->input('mail_body');
        $created_at = date('Y-m-d H:i:s');

}
public function update() {

}
    public function moveToTrash($id)
    {
        DB::update('UPDATE mails SET mail_folder="trash" WHERE mail_id = ?', [$id]);
        return redirect()->action([MailsController::class, 'index'])->with('success', 'Message moved successfully');

    }

    public function movetoFolder($id, Request $request)
    {
        error_reporting(E_ALL);
        $folder = $request->foldername;
        DB::table('mails')->where('mail_id', '=', $id)->update(['mail_folder' => $folder]);
        return redirect()->action([MailsController::class, 'index'])->with('success', 'Message moved successfully');
    }

    public function restore($id)
    {
        DB::update('UPDATE mails SET mail_folder="inbox" WHERE mail_id = ?', [$id]);
        return redirect()->action([MailsController::class, 'index'])->with('success', 'Message restored successfully');
    }


    public function destroy(Request $request)
    {

    }
}
