<?php

namespace App\Http\Controllers;
session_start();



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;



class MailsController extends Controller
{
    public function index()
    {
        $user_id = Auth::id();
        $msgcount = DB::table('config')->select('msgcount')->where('us_id', '=', $user_id)->get();
        foreach ($msgcount as $count) {
            $number = $count->msgcount;
        }

        $mysteryfold = DB::table('config')->select('folders')->where('us_id', '=', $user_id)->simplepaginate($number);
        $inbox = DB::table('mails')->where('mail_folder', '=', 'inbox',)->where('user_id', '=', $user_id)->simplepaginate($number);
        $sent = DB::table('mails')->where('mail_folder', '=', 'sent')->where('user_id', '=', $user_id)->simplepaginate($number);
        $drafts = DB::table('mails')->where('mail_folder', '=', 'drafts')->where('user_id', '=', $user_id)->simplepaginate($number);
        $trash = DB::table('mails')->where('mail_folder', '=', 'trash')->where('user_id', '=', $user_id)->simplepaginate($number);
        $configuration = DB::table('config')->join('users', 'users.id', '=', 'config.us_id')->where('users.id', '=', $user_id)->get();
        $folderview = DB::table('config')->select('mailboxview')->where('us_id', '=', $user_id)->get();
        foreach ($folderview as $fview) {
            $view = $fview->mailboxview;
        }
        switch ($view) {
            case 'compact':
                return view('mails.index', ['inbox' => $inbox, 'sent' => $sent, 'drafts' => $drafts, 'trash' => $trash, 'configuration' => $configuration, 'mysteryfold' => $mysteryfold, 'number' => $number, 'view' => $view]);
                break;
            case 'buisness':
                return view('mails.buisness', ['inbox' => $inbox, 'sent' => $sent, 'drafts' => $drafts, 'trash' => $trash, 'configuration' => $configuration, 'mysteryfold' => $mysteryfold, 'number' => $number, 'view' => $view]);
                break;

            default:
                return view('mails.index', ['inbox' => $inbox, 'sent' => $sent, 'drafts' => $drafts, 'trash' => $trash, 'configuration' => $configuration, 'mysteryfold' => $mysteryfold, 'number' => $number, 'view' => $view]);

                break;
        }
    }

    public function show($id)
    {
        $user_id = Auth::id();
        $name = Auth::user()->name;
        $email = Auth::user()->email;
        $users = DB::select('SELECT name,email FROM users WHERE name != ? AND email !=?', [$name, $email]);
        $change = DB::table('mails')->where('mail_id', '=', $id)->update(['mail_status' => 'seen']);
        $show = DB::table('mails')->where('mail_id', '=', $id)->get();
        $showcog = DB::table('config')->join('mails', 'mails.user_id', '=', 'config.us_id')->where('user_id', '=', $user_id)->get();

        return view('mails.showMail', ['show' => $show, 'showcog' => $showcog, 'users' => $users]);

    }

    public function create()
    {
        $name = Auth::user()->name;
        $email = Auth::user()->email;
        $users = DB::select('SELECT name,email FROM users WHERE name != ? AND email !=?', [$name, $email]);
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
        $recipient_id = DB::table('users')->select('id')->where('email', '=', $mail_recipient)->get();
        foreach ($recipient_id as $rid) {
            $recipientid = $rid->id;
        }
        $udw_id = DB::table('users')->select('id')->where('email', '=', $udw)->get();
        $dw_id = DB::table('users')->select('id')->where('email', '=', $dw)->get();
        foreach ($dw_id as $did) {
            $dwid = $did->id;
        }
        foreach ($udw_id as $udid) {
            $udwid = $udid->id;
        }


        if ($_POST["mail_dw"]) {
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
                'mail_recipient' => $dw,
                'mail_title' => $mail_title,
                'mail_body' => $mail_body,
                'mail_dw' => $dw,
                'mail_udw' => $udw,
                'mail_folder' => "inbox",
                'mail_status' => "unseen",
                'created_at' => $created_at,
                'user_id' => $dwid

            ]);

        } else if ($_POST["mail_udw"]) {
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
                'mail_recipient' => $dw,
                'mail_title' => $mail_title,
                'mail_body' => $mail_body,
                'mail_dw' => $dw,
                'mail_udw' => $udw,
                'mail_folder' => "inbox",
                'mail_status' => "unseen",
                'created_at' => $created_at,
                'user_id' => $dwid

            ]);
            DB::table('mails')->insert([
                'mail_sender' => $mail_sender,
                'mail_recipient' => $udw,
                'mail_title' => $mail_title,
                'mail_body' => $mail_body,
                'mail_dw' => $dw,
                'mail_udw' => $udw,
                'mail_folder' => "inbox",
                'mail_status' => "unseen",
                'created_at' => $created_at,
                'user_id' => $udwid

            ]);
        } else {
            DB::table('mails')->insert([
                'mail_sender' => $mail_sender,
                'mail_recipient' => $mail_recipient,
                'mail_title' => $mail_title,
                'mail_body' => $mail_body,
                'mail_dw' => null,
                'mail_udw' => null,
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
                'mail_dw' => null,
                'mail_udw' => null,
                'mail_folder' => "inbox",
                'mail_status' => "unseen",
                'created_at' => $created_at,
                'user_id' => $recipientid

            ]);
        }
        return redirect()->action([MailsController::class, 'index'])->with('success', 'Message sent successfully');
    }

    public function changelayout(Request $request)
    {
        $user_id = $request->input('user_id');
        $layout = $request->input('layout');
        DB::update('UPDATE config SET mailboxview =? WHERE us_id = ?', [$layout, $user_id]);
        return redirect()->action([MailsController::class, 'index']);
    }

    public function reply(Request $request)
    {

        $mail_sender = $request->input('mail_sender');
        $mail_recipient = $request->input('mail_recipient');
        $recipient_id = DB::table('users')->select('id')->where('email', '=', $mail_recipient)->get();
        $sender_id = DB::table('users')->select('id')->where('email', '=', $mail_sender)->get();
        foreach ($recipient_id as $rid) {
            $recipientid = $rid->id;
        }
        foreach ($sender_id as $sid) {
            $senderid = $sid->id;
        }
        $mail_title = $request->input('mail_title');
        $mail_body = $request->input('mail_body');
        $created_at = date('Y-m-d H:i:s');
        DB::table('mails')->insert([
            'mail_sender' => $mail_sender,
            'mail_recipient' => $mail_recipient,
            'mail_title' => $mail_title,
            'mail_body' => $mail_body,
            'created_at' => $created_at,
            'mail_folder' => 'sent',
            'mail_status' => 'seen',
            'user_id' => $senderid
        ]);
        DB::table('mails')->insert([
            'mail_sender' => $mail_sender,
            'mail_recipient' => $mail_recipient,
            'mail_title' => $mail_title,
            'mail_body' => $mail_body,
            'created_at' => $created_at,
            'mail_folder' => 'inbox',
            'mail_status' => 'unseen',
            'user_id' => $recipientid
        ]);
        return redirect()->action([MailsController::class, 'index'])->with('success', 'Message sent successfully');


    }

    public function forward(Request $request)
    {
        $mail_sender = $request->input('mail_sender');
        $mail_recipient = $request->input('mail_recipient');
        $recipient_id = DB::table('users')->select('id')->where('email', '=', $mail_recipient)->get();
        $sender_id = DB::table('users')->select('id')->where('email', '=', $mail_sender)->get();
        foreach ($recipient_id as $rid) {
            $recipientid = $rid->id;
        }
        foreach ($sender_id as $sid) {
            $senderid = $sid->id;
        }
        $mail_title = $request->input('mail_title');
        $mail_body = $request->input('mail_body');
        $created_at = date('Y-m-d H:i:s');
        DB::table('mails')->insert([
            'mail_sender' => $mail_sender,
            'mail_recipient' => $mail_recipient,
            'mail_title' => $mail_title,
            'mail_body' => $mail_body,
            'created_at' => $created_at,
            'mail_folder' => 'sent',
            'mail_status' => 'seen',
            'user_id' => $senderid
        ]);
        DB::table('mails')->insert([
            'mail_sender' => $mail_sender,
            'mail_recipient' => $mail_recipient,
            'mail_title' => $mail_title,
            'mail_body' => $mail_body,
            'created_at' => $created_at,
            'mail_folder' => 'inbox',
            'mail_status' => 'unseen',
            'user_id' => $recipientid
        ]);
        return redirect()->action([MailsController::class, 'index'])->with('success', 'Message sent successfully');

    }

    public function update()
    {

    }

    public function msgcount(Request $request)
    {
        $msgcount = $request->input('msgcount');
        $user_id = Auth::user()->id;
        DB::update('UPDATE config SET msgcount = ? WHERE us_id = ?', [$msgcount, $user_id]);
        return redirect()->action([MailsController::class, 'index'])->with('success', 'Changed  succesfully');

    }

    public function addfolders(Request $request)
    {
        $folder = $request->input('mail_folder');
        $user_id = $request->input('user_id');
        $list = DB::table('config')->select('folders')->where('us_id', '=', $user_id)->get();
        foreach ($list as $ls) {
            if (empty($ls->folders)) {
                $newArray .= $folder;
            } else {
                $newArray = $ls->folders . ',' . $folder;
            }
        }
        DB::update('UPDATE config SET folders = ? WHERE us_id = ? ', [$newArray, $user_id]);
        return redirect()->action([MailsController::class, 'index'])->with('success', 'List of folders updated succesfully');
    }

    public function deletefolder(Request $request)
    {
        $user_id = $request->input('user_id');
        $list = DB::table('config')->select('folders')->where('us_id', '=', $user_id)->get();
        $foldertodelete = $_POST["folder"];
        foreach ($list as $l) {
            $newlist = explode(',', $l->folders);
        }
        foreach ($foldertodelete as $folder) {
            if (in_array($folder, $newlist)) {
                $flipped = array_flip($newlist);
                unset($flipped[$folder]);
                $newarray = array_flip($flipped);
                $flippedstring = implode(',', $newarray);
                DB::update('UPDATE config SET folders=? WHERE us_id = ?', [$flippedstring, $user_id]);
                if (empty($flipped)) {
                    DB::update('UPDATE config SET folders =  null WHERE id = ?', [$user_id]);
                }
            } else {
                echo "Nie ok";
            }

        }
        return redirect()->action([MailsController::class, 'index'])->with('success', 'List of folders updated succesfully');


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
