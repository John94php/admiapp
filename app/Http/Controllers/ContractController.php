<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContractController extends Controller
{
    public function index() {
        $contracts = DB::table('contracts')->join('types','types.type_id','=','contracts.contracttype')->get();
       /* echo '<pre>';
        var_dump($contracts);
        echo '</pre>';*/
        return view('contracts.index',['contracts'=>$contracts]);
    }
}
