<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
class DocumentController extends Controller
{
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = Document::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-outline-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-outline-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('documents.index');
    }
}
