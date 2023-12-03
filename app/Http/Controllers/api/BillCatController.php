<?php

namespace App\Http\Controllers\api;

use App\Models\Bill_cat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class BillCatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bill_cat = Bill_cat::all();
        return response()->json([
            'status'=> true,
            'message' => 'data berhasil ditemukan',
            'data' => $bill_cat
        ],200);    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $bill_cat = new Bill_cat();
        
        $rules = [
            'name' => 'required',
            'desc' => 'required',
            'price' => 'required|int'
        ];
        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()){
            return response()->json([
                'status'=> false,
                'message' => 'data belum lengkap',
                'data' => $validator->errors()
            ]);    
        }

        $bill_cat->name = $req->name;
        $bill_cat->desc = $req->desc;
        $bill_cat->price = $req->price;
        $bill_cat->save();

        return response()->json([
            'status'=> true,
            'message' => 'data berhasil disimpan',
            'data' => $bill_cat
        ],200);   

       
       
        // $bill_cat = Bill_cat::create([
        //     'name' => $req->name,
        //     'desc' => $req->desc,
        //     'price' => $req->price
        // ]);
        // return response()->json([
        //     'data' => $bill_cat
        // ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bill_cat  $bill_cat
     * @return \Illuminate\Http\Response
     */
    public function show(Bill_cat $bill_cat,string $id)
    {
        $bill_cat = Bill_cat::find($id);
        if($bill_cat){
            return response()->json([
                'status' => true,
                'message' => 'data ditemukan',
                'data' => $bill_cat
            ],200);
        }else {
            return response()->json([
                'status' => false,
                'message' => 'data tidak ditemukan',
            ]);
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bill_cat  $bill_cat
     * @return \Illuminate\Http\Response
     */
    public function edit(Bill_cat $bill_cat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bill_cat  $bill_cat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, string $id)
    {
        $bill_cat = Bill_cat::find($id);
        if(empty($bill_cat)){
            return response()->json([
                'status'=> false,
                'message' => 'data tidak ditemukan',
                'data' => $validator->errors()
            ],404);   
        }
        
        $rules = [
            'name' => 'required',
            'desc' => 'required',
            'price' => 'required'
        ];
        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()){
            return response()->json([
                'status'=> false,
                'message' => 'data belum lengkap',
                'data' => $validator->errors()
            ]);    
        }

        $bill_cat->name = $req->name;
        $bill_cat->desc = $req->desc;
        $bill_cat->price = $req->price;
        $bill_cat->save();

        return response()->json([
            'status'=> true,
            'message' => 'data berhasil diupdate',
            'data' => $bill_cat
        ],200);   

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bill_cat  $bill_cat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bill_cat $bill_cat, $id)
    {
        $bill_cat = Bill_cat::find($id);
        if(empty($bill_cat)){
            return response()->json([
                'status'=> false,
                'message' => 'data tidak ditemukan',
                'data' => $validator->errors()
            ],404);   
        }
        
        $bill_cat->delete();

        return response()->json([
            'status'=> true,
            'message' => 'data berhasil dihapus',
        ],200);   
    }
}
