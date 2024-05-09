<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class UserController extends Controller
{

    const Api_url_user = 'localhost:8000/api/user?';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $token =  session()->get('login_token');
        if($token == null){
            return redirect()->to('login')->with('error', 'anda belum login');
        } else {

            $user = new Client();
            
            // data user
            $url = static::Api_url_user;
            if ($req->input('page') != '') {
                $url .= "page=". $req->input('page');
            }
            if ($req->input('keyword') != '') {
                $url .= "keyword=". $req->input('keyword');
            }
            if ($req->input('sortBy') != '') {
                $url .= "sortBy=". $req->input('sortBy');
            }
            if ($req->input('sortOrder') != '') {
                $url .= "sortOrder=". $req->input('sortOrder');
            }
            $reponse = $user->request('get', $url, [
                'headers' => [ 'Authorization' => 'Bearer ' . $token ]
            ]);
            $gt_content = json_decode($reponse->getBody()->getContents(), true);
            $data = $gt_content['data'];
            foreach ($data['links'] as $key => $val) {
                $data['links'][$key]['url_fix'] = str_replace(static::Api_url_user, "localhost:8001/user?", $val['url']);
            }

            // data category
            $urlcat = 'localhost:8000/api/bill_cat_all';
            $reponsecat = $user->request('get', $urlcat, [
                'headers' => [ 'Authorization' => 'Bearer ' . $token ]
            ]);
            $gt_category = json_decode($reponsecat->getBody()->getContents(), true);
            $category = $gt_category['data'];

            return view('content.user', ['data'=> $data, 'category'=> $category]);
        }
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
        $token =  session()->get('login_token');
        
        $pic = $req->file('pic');

        $img_path = $pic->getPathname();
        $img_mime = $pic->getMimeType('image');
        $img_upname = $pic->getClientOriginalName();
       
        $user = new Client();
        $url = 'localhost:8000/api/user';
        $reponse = $user->request('post', $url, [
            'headers' => [ 'Authorization' => 'Bearer ' . $token ],
            'multipart' => [
                [
                    'name'     => 'pic',
                    'filename' => $img_upname,
                    'Mime-Type' => $img_mime,
                    'contents' => fopen($img_path, 'r'),
                ],
                [
                    'name'     => 'name',
                    'contents' => $req->name,
                ],
                [
                    'name'     => 'email',
                    'contents' => $req->email,
                ],
                [
                    'name'     => 'password',
                    'contents' => $req->password,
                ],
                [
                    'name'     => 'role',
                    'contents' => $req->role,
                ],
                [
                    'name'     => 'bill_cat',
                    'contents' => $req->bill_cat,
                ],
                [
                    'name'     => 'telp',
                    'contents' => $req->telp,
                ],
                [
                    'name'     => 'status',
                    'contents' => 'n',
                ],
                [
                    'name'     => 'address',
                    'contents' => $req->address,
                ],
            ],
        ]);
        
        $gt_content = json_decode($reponse->getBody()->getContents(), true);
        if($gt_content['status'] != true){
            $error = $gt_content['data'];
            return redirect()->to('user')->withErrors($error)->withInput();
        }else {
            return redirect()->to('user')->with('success', 'berhasil menambah data');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     echo "hello";
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $req, $id)
    {
        $token =  session()->get('login_token');            

        if ($req->file('pic')) {
            $pic = $req->file('pic');
            $valpic = [
                'name'     => 'pic',
                'filename' => $pic->getClientOriginalName(),
                'Mime-Type' => $pic->getMimeType('image'),
                'contents' => fopen($pic->getPathname(), 'r')
            ];
        } else {
            $valpic = [
                'name'     => 'pic',
                'contents' => null
            ];
        }

        $password = null;
        if ($req->password != null) {
            $password = $req->password;
        }

        // print_r($req->name);
        // exit();

        $edt_user = new Client();
        $url = 'localhost:8000/api/user/'.$id.'?_method=PUT';
        $response = $edt_user->request('post', $url, [
            'headers'=>['Authorization' => 'Bearer ' . $token ],
            'multipart' => [
                $valpic,
                [
                    'name'     => 'name',
                    'contents' => $req->name
                ],
                [
                    'name'     => 'email',
                    'contents' => $req->email
                ],
                [
                    'name'     => 'password',
                    'contents' => $password
                ],
                [
                    'name'     => 'role',
                    'contents' => $req->role
                ],
                [
                    'name'     => 'bill_cat',
                    'contents' => $req->bill_cat
                ],
                [
                    'name'     => 'telp',
                    'contents' => $req->telp
                ],
                [
                    'name'     => 'status',
                    'contents' => $req->status
                ],
                [
                    'name'     => 'address',
                    'contents' => $req->address
                ],
            ],
        ]);

        // print_r($reponse);
        // exit();

        $gt_content = json_decode($response->getBody()->getContents(), true);
        if($gt_content['status'] != true){
            $error = $gt_content['data'];
            return redirect()->to('user')->withErrors($error)->withInput();
        }else {
            return redirect()->to('user')->with('success', 'berhasil mengubah data');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $token =  session()->get('login_token');
        $user = new Client();
        $url = 'localhost:8000/api/user/'.$id;
        $reponse = $user->request('delete', $url, [
            'headers' => [ 'Authorization' => 'Bearer ' . $token ]
        ]);
        $gt_content = json_decode($reponse->getBody()->getContents(), true);
        if($gt_content['status'] != true){
            $error = $gt_content['data'];
            return redirect()->to('user')->withErrors($error)->withInput();
        }else {
            return redirect()->to('user')->with('success', 'berhasil menghapus data');
        }
    }
}
