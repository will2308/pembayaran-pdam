<?php

namespace App\Http\Controllers\api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $user = User::paginate(5);

        if($req->all){
            $user = User::all(); 
        }
        // keyword
        if($req->keyword){
            $user = User::where('name', 'like','%'.$req->keyword.'%')->orwhere('email', 'like','%'.$req->keyword.'%')->orwhere('address', 'like','%'.$req->keyword.'%')->paginate(5); 
        }
        // sortBy
        if ($req->sortBy && in_array($req->sortBy,['id','created_at'])) {
            $sortBy = $req->sortBy;
        } else {
            $sortBy = 'id';
        }
        // orderBy
        if ($req->sortOrder && in_array($req->sortOrder,['asc','desc'])) {
            $sortOrder = $req->sortOrder;
        } else {
            $sortOrder = 'asc';
        }

        if($user != null){
            return response()->json([
                'status' => true,
                'message' => 'data ditemukan',
                'data' => $user
            ],200);
        }else {
            return response()->json([
                'status' => false,
                'message' => 'data kosong',
            ]);
        } 
    }

    public function all(){
        $user = User::all();
        return response()->json([
            'status' => true,
            'message' => 'data ditemukan',
            'data' => $user
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
        $user = new User();
        
        $rules = [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'role' => 'required',
            'telp' => 'required',
            'status' => 'required',
            'address' => 'required',
        ];
        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()){
            return response()->json([
                'status'=> false,
                'message' => 'data belum lengkap',
                'data' => $validator->errors()
            ]);    
        }

        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = Hash::make($req->password);
        $user->role = $req->role;
        $user->bill_cat = $req->bill_cat;
        $user->telp = $req->telp;
        $user->status = $req->status;
        $user->address = $req->address;
        if($req->hasfile('pic')){
            $upload_image_name = $req->email.date('dmY').'.'.$req->file('pic')->extension();
            $req->pic->move('assets/profil_img', $upload_image_name);        
        } else {
        $upload_image_name = "Noimage";
        }
        $user->pic = $upload_image_name;
        $user->save();

        return response()->json([
            'status'=> true,
            'message' => 'data berhasil disimpan',
            'data' => $user
        ],200);   
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        $user = User::find($id);
        if($user){
            return response()->json([
                'status' => true,
                'message' => 'data ditemukan',
                'data' => $user
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, string $id)
    {
        $user = User::find($id);
        if(empty($user)){
            return response()->json([
                'status'=> false,
                'message' => 'data tidak ditemukan',
            ],404);   
        }
        
        $rules = [
            'name' => 'required',
            'email' => 'required',
            'role' => 'required',
            'telp' => 'required',
            'status' => 'required',
            'address' => 'required',
        ];
        $validator = Validator::make($req->all(), $rules);
        if ($validator->fails()){
            return response()->json([
                'status'=> false,
                'message' => 'data belum lengkap',
                'data' => $validator->errors()
            ]);    
        }

        $user->name = $req->name;
        $user->email = $req->email;
        if ($req->password == null) {
            $user->password = $user->password;
        } else {
            $user->password = Hash::make($req->password);
        }
        $user->role = $req->role;
        $user->bill_cat = $req->bill_cat;
        $user->telp = $req->telp;
        $user->status = $req->status;
        $user->address = $req->address;
        if($req->hasfile('pic')){
            $upload_image_name = $req->email.date('dmY').'.'.$req->file('pic')->extension();
            $req->pic->move('assets/profil_img', $upload_image_name);      
            $user->pic = $upload_image_name;  
        } else {
            $user->pic = $user->pic;
        }
        
        $user->save();

        return response()->json([
            'status'=> true,
            'message' => 'data berhasil diupdate',
            'data' => $user
        ],200);   

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $user = User::find($id);
        if(empty($user)){
            return response()->json([
                'status'=> false,
                'message' => 'data tidak ditemukan',
            ],404);   
        }
        
        $user->delete();

        return response()->json([
            'status'=> true,
            'message' => 'data berhasil dihapus',
        ],200);   
    }
}
