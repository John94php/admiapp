<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;
class DocumentController extends Controller
{
    public function index(Request $request) {


        $documents = DB::table('documents')->join('users','users.id','=','documents.us_id')->select('users.name','documents.title','documents.size','documents.type','documents.id','documents.us_id')->where('status','=',1)->get();
        $archives = DB::table('documents')->join('users','users.id','=','documents.us_id')->select('users.name','documents.title','documents.size','documents.type','documents.id','documents.us_id','documents.updated_at')->where('status','=',2)->get();


        $types = DB::table('docslo')->get();
        return view('documents.index',['documents'=>$documents,'types'=>$types,'archives'=>$archives]);
    }
    public function store(Request $request) {
        $user = Auth::user()->name;
        $user_id = Auth::id();
        $name = $request->input('name');
        $type = $request->input('type');
        $typename = $request->input('typename');
        $file = $request->file('filedoc');
        $extension = $file->getClientOriginalExtension();
        $filename = $name.'.'.$extension;
        $content = file_get_contents($file->getRealPath());
        Storage::disk('local')->put("documents/".$user_id."/".$filename,$content);
        $ext =  $request->filedoc->getClientOriginalExtension();
        $storagePath  = Storage::disk('local')->getDriver()->getAdapter()->getPathPrefix();
            $path = $storagePath."documents\\".$user_id."\\".$filename;
            $typelist = DB::table('docslo')->select('name')->where('id','=',$type)->get();

            foreach($typelist as $typ) {
                $list = $typ->name;
            }
            if($type) {
                DB::table('documents')->insert([
                   'title'=>$filename,
                    'type' =>$list,
                    'size' =>$_FILES['filedoc']["size"],
                    'path' =>$path,
                    'us_id' =>$user_id,
                    'created_at' =>date('Y-m-d H:i:s'),
                    'ext' =>$ext,
                    'status' =>1
                ]);
            }
         if($typename) {
                DB::table('documents')->insert([
                    'title'=>$filename,
                    'type' =>$typename,
                    'size' =>$_FILES['filedoc']["size"],
                    'us_id' =>$user_id,
                    'path' =>$path,
                    'created_at' =>date('Y-m-d H:i:s'),
                    'ext' =>$ext,
                    'status' =>1

                ]);

            }

      return redirect()->action([DocumentController::class, 'index'])->with('success', 'Success');

    }
    public function get_file($user,$file)
    {

        return response()->download(storage_path("app\\documents\\{$user}\\{$file}"));
    }
    public function edit() {

    }
    public function deletedoc($id,$file)
    {
            DB::table('documents')->where('id',$id)->update(['status'=>2,'updated_at'=>date('Y-m-d H:i:s')]);
        return redirect()->action([DocumentController::class, 'index']);

    }
}
