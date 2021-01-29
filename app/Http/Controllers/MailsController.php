<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mails;
use Illuminate\Support\Facades\DB;

class MailsController extends Controller
{
    public function index() {
        $inbox = DB::table('mails')->where('mail_folder','=','inbox')->get();
        return view('mails.index',['inbox'=>$inbox]);
    }
    public function create() {

    }
    public function store() {

    }
    public function delete() {

    }
}
