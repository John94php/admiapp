<?php

namespace App\Http\Controllers;
session_start();


use Illuminate\Http\Request;
use App\Models\Mails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


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
//        $user_id = Auth::user()->id;
        $user_mail = Auth::user()->email;

        $mail_sender = $request->input('mail_sender');
        $mail_recipient = $request->input('mail_recipient');
        $mail_title = $request->input('mail_title');
        $mail_body = $request->input('mail_body');
        $dw = $request->input('dw');
        $udw = $request->input('udw');
        $mail_body = $request->input('mail_body');
        $attachment1 = $request->input('mail_attachment1');
        $attachment2 = $request->input('mail_attachment2');
        $attachment3 = $request->input('mail_attachment3');
        $attachment4 = $request->input('mail_attachment4');

        $recipient_id = DB::table('mails')->join('users','users.email','=','mails.mail_recipient')->select('users.id')->where('users.email','LIKE',$mail_recipient)->get();
            foreach($recipient_id as $rid) {
            $recipient_id = $rid->id;

            }
        $dw_id = DB::table('mails')->join('users','users.email','=','mails.mail_dw')->select('users.id')->where('users.email','LIKE',$dw)->get();
        foreach($dw_id as $did) {
            var_dump($did);
            $dw_id = $did->id;
        }
     $udw_id = DB::table('mails')->join('users','users.email','=','mails.mail_udw')->select('users.id')->where('users.email','LIKE',$udw)->get();
            foreach($udw_id as $udid) {
            var_dump($udid);
                $udw_id = $udid->id;
            }
        if(isset($_POST["mail_attachmentflag"])) {
            $attachment_flag = 1;
        } else {
            $attachment_flag = 0;
        }
        if(isset($_POST["dw"])) {
            DB::table('mails')->insert([
               'mail_sender' => $mail_sender,
                'mail_recipient' =>$mail_recipient,
                'mail_title' =>$mail_title,
                'mail_body' =>$mail_body,
                'mail_attachmentflag' =>$attachment_flag,
                'mail_attachment1' =>$attachment1,
                'mail_attachment2' =>$attachment2,
                'mail_attachment3' =>$attachment3,
                'mail_attachment4' => $attachment4,
                'mail_dw' =>$dw,
                'mail_udw' =>$udw,
                'mail_folder' =>"sent",
                'mail_status' =>"seen",
                'created_at' =>date('Y-m-d H:i:s'),
                'user_id' => $user_id

            ]);
            DB::table('mails')->insert([
                'mail_sender' => $mail_sender,
                'mail_recipient' =>$mail_recipient,
                'mail_title' =>$mail_title,
                'mail_body' =>$mail_body,
                'mail_attachmentflag' =>$attachment_flag,
                'mail_attachment1' =>$attachment1,
                'mail_attachment2' =>$attachment2,
                'mail_attachment3' =>$attachment3,
                'mail_attachment4' => $attachment4,
                'mail_dw' =>$dw,
                'mail_udw' =>$udw,
                'mail_folder' =>"inbox",
                'mail_status' =>"unseen",
                'created_at' =>date('Y-m-d H:i:s'),
                'user_id' => $recipient_id

            ]);
            DB::table('mails')->insert([
                'mail_sender' => $mail_sender,
                'mail_recipient' =>$mail_recipient,
                'mail_title' =>$mail_title,
                'mail_body' =>$mail_body,
                'mail_attachmentflag' =>$attachment_flag,
                'mail_attachment1' =>$attachment1,
                'mail_attachment2' =>$attachment2,
                'mail_attachment3' =>$attachment3,
                'mail_attachment4' => $attachment4,
                'mail_dw' =>$dw,
                'mail_udw' =>$udw,
                'mail_folder' =>"inbox",
                'mail_status' =>"unseen",
                'created_at' =>date('Y-m-d H:i:s'),
                'user_id' => $dw_id

            ]);
            if(isset($_POST["mail_udw"]) && isset($_POST["udw"])) {
                DB::table('mails')->insert([
                    'mail_sender' => $mail_sender,
                    'mail_recipient' =>$mail_recipient,
                    'mail_title' =>$mail_title,
                    'mail_body' =>$mail_body,
                    'mail_attachmentflag' =>$attachment_flag,
                    'mail_attachment1' =>$attachment1,
                    'mail_attachment2' =>$attachment2,
                    'mail_attachment3' =>$attachment3,
                    'mail_attachment4' => $attachment4,
                    'mail_dw' =>$dw,
                    'mail_udw' =>$udw,
                    'mail_folder' =>"sent",
                    'mail_status' =>"seen",
                    'created_at' =>date('Y-m-d H:i:s'),
                    'user_id' => $user_id

                ]);
                DB::table('mails')->insert([
                    'mail_sender' => $mail_sender,
                    'mail_recipient' =>$mail_recipient,
                    'mail_title' =>$mail_title,
                    'mail_body' =>$mail_body,
                    'mail_attachmentflag' =>$attachment_flag,
                    'mail_attachment1' =>$attachment1,
                    'mail_attachment2' =>$attachment2,
                    'mail_attachment3' =>$attachment3,
                    'mail_attachment4' => $attachment4,
                    'mail_dw' =>$dw,
                    'mail_udw' =>$udw,
                    'mail_folder' =>"inbox",
                    'mail_status' =>"unseen",
                    'created_at' =>date('Y-m-d H:i:s'),
                    'user_id' => $recipient_id
               ]);
                DB::table('mails')->insert([
                    'mail_sender' => $mail_sender,
                    'mail_recipient' =>$mail_recipient,
                    'mail_title' =>$mail_title,
                    'mail_body' =>$mail_body,
                    'mail_attachmentflag' =>$attachment_flag,
                    'mail_attachment1' =>$attachment1,
                    'mail_attachment2' =>$attachment2,
                    'mail_attachment3' =>$attachment3,
                    'mail_attachment4' => $attachment4,
                    'mail_dw' =>$dw,
                    'mail_udw' =>$udw,
                    'mail_folder' =>"inbox",
                    'mail_status' =>"unseen",
                    'created_at' =>date('Y-m-d H:i:s'),
                    'user_id' => $dw_id

                ]);
                DB::table('mails')->insert([
                    'mail_sender' => $mail_sender,
                    'mail_recipient' =>$mail_recipient,
                    'mail_title' =>$mail_title,
                    'mail_body' =>$mail_body,
                    'mail_attachmentflag' =>$attachment_flag,
                    'mail_attachment1' =>$attachment1,
                    'mail_attachment2' =>$attachment2,
                    'mail_attachment3' =>$attachment3,
                    'mail_attachment4' => $attachment4,
                    'mail_dw' =>$dw,
                    'mail_udw' =>$udw,
                    'mail_folder' =>"inbox",
                    'mail_status' =>"unseen",
                    'created_at' =>date('Y-m-d H:i:s'),
                    'user_id' => $udw_id

                ]);
            }
        } else {
            DB::table('mails')->insert([
                'mail_sender' => $mail_sender,
                'mail_recipient' =>$mail_recipient,
                'mail_title' =>$mail_title,
                'mail_body' =>$mail_body,
                'mail_attachmentflag' =>$attachment_flag,
                'mail_attachment1' =>$attachment1,
                'mail_attachment2' =>$attachment2,
                'mail_attachment3' =>$attachment3,
                'mail_attachment4' => $attachment4,
                'mail_dw' =>null,
                'mail_udw' =>null,
                'mail_folder' =>"sent",
                'mail_status' =>"seen",
                'created_at' =>date('Y-m-d H:i:s'),
                'user_id' => $user_id

            ]);
            DB::table('mails')->insert([
                'mail_sender' => $mail_sender,
                'mail_recipient' =>$mail_recipient,
                'mail_title' =>$mail_title,
                'mail_body' =>$mail_body,
                'mail_attachmentflag' =>$attachment_flag,
                'mail_attachment1' =>$attachment1,
                'mail_attachment2' =>$attachment2,
                'mail_attachment3' =>$attachment3,
                'mail_attachment4' => $attachment4,
                'mail_dw' =>null,
                'mail_udw' =>null,
                'mail_folder' =>"inbox",
                'mail_status' =>"unseen",
                'created_at' =>date('Y-m-d H:i:s'),
                'user_id' => $recipient_id

            ]);
        }
        return redirect()->action([MailsController::class, 'index'])->with('success', 'Message sent successfully');
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
