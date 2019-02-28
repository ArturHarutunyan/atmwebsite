<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ModalController extends Controller
{

    public function index(Request $request)
    {
        $data = DB::table($request->table_name.'_translations')->where([
            ['locale', '=', $request->locale],
            [$request->table_name.'_id', '=', $request->id],
        ])->first();
        if($request->table_name=='video') {
            $source_code_row = DB::table($request->table_name.'s')->where('id',$request->id)->first();
            $source_code=$source_code_row->source_code;
            $data->source_code = $source_code;
        }
        return json_encode($data);
    }

}
