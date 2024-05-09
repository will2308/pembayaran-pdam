<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class BillCatController extends Controller
{

    const Api_url_billcat = 'localhost:8000/api/bill_cat?';
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

            $kategori = new Client();
            
            $url = static::Api_url_billcat;
            if ($req->input('page') != '') {
                $url .= "page=". $req->input('page');
            }
            
            if ($req->input('sortBy') != '') {
                $url .= "sortBy=". $req->input('sortBy');
            }
            if ($req->input('sortOrder') != '') {
                $url .= "sortOrder=". $req->input('sortOrder');
            }
            $reponse = $kategori->request('get', $url, [
                'headers' => [ 'Authorization' => 'Bearer ' . $token ]
            ]);
            $gt_content = json_decode($reponse->getBody()->getContents(), true);
            $data = $gt_content['data'];
            foreach ($data['links'] as $key => $val) {
                $data['links'][$key]['url_fix'] = str_replace(static::Api_url_billcat, "localhost:8001/kategori?", $val['url']);
            }
            // echo $value['url']."<br>";
            // print_r($data['links'][1]['url_fix']);
            return view('content.bill_cat', ['data'=> $data]);
        }
    }

    public function search(Request $req)
    {

        $token =  session()->get('login_token');
        if($token == null){
            return redirect()->to('login')->with('error', 'anda belum login');
        } else {

            $kategori = new Client();
            
            $url = 'localhost:8000/api/bill_cat?keyword='.$req->keyword;
            if ($req->input('page') != '') {
                $url ."&page=". $req->input('page');
            }
            $res = $kategori->request('get', $url, [
                'headers' => [ 'Authorization' => 'Bearer ' . $token ]
            ]);
            $gt_content = json_decode($res->getBody()->getContents(), true);
            // print_r($gt_content['data']);
            // echo $url;
            // exit();
            $data = $gt_content['data'];
            foreach ($data['links'] as $key => $val) {
                $data['links'][$key]['url_fix'] = str_replace($url, "localhost:8001/kategori?keyword=".$req->keyword.'&', $val['url']);
            }
            // print_r($data['links'])."<br>";
            // echo $val['url']."<br>";
            // print_r($data['links'][1]['url_fix']);
            return view('content.bill_cat', ['data'=> $data]);
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
        $name = $req->name;
        $desc = $req->desc;
        $price = $req->price;
        $parameter = [
            'name'=> $name,
            'desc'=> $desc,
            'price'=> $price
        ];

        $kategori = new Client();
        $url = 'localhost:8000/api/bill_cat';
        $reponse = $kategori->request('post', $url, [
            'headers'=>[
                'Content-type'=>'aplication/json',
                'Authorization' => 'Bearer ' . $token
            ],
            'body'=>json_encode($parameter)
        ]);
        $gt_content = json_decode($reponse->getBody()->getContents(), true);
        // $data = $gt_content['data'];
        // echo $gt_content;
        // print_r($data);
        if($gt_content['status'] != true){
            $error = $gt_content['data'];
            return redirect()->to('kategori')->withErrors($error)->withInput();
        }else {
            return redirect()->to('kategori')->with('success', 'berhasil menambah data');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $req, $id)
    {
        $token =  session()->get('login_token');
        $name = $req->name;
        $desc = $req->desc;
        $price = $req->price;
        $parameter = [
            'name'=> $name,
            'desc'=> $desc,
            'price'=> $price
        ];

        $kategori = new Client();
        $url = 'localhost:8000/api/bill_cat/'.$id;
        $reponse = $kategori->request('put', $url, [
            'headers'=>[
                'Content-type'=>'aplication/json',
                'Authorization' => 'Bearer ' . $token
            ],
            'body'=>json_encode($parameter)
        ]);
        $gt_content = json_decode($reponse->getBody()->getContents(), true);
        // $data = $gt_content['data'];
        // echo $gt_content;
        // print_r($data);
        if($gt_content['status'] != true){
            $error = $gt_content['data'];
            return redirect()->to('kategori')->withErrors($error)->withInput();
        }else {
            return redirect()->to('kategori')->with('success', 'berhasil mengubah data');
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
        $kategori = new Client();
        $url = 'localhost:8000/api/bill_cat/'.$id;
        $reponse = $kategori->request('delete', $url, [
            'headers' => [ 'Authorization' => 'Bearer ' . $token ]
        ]);
        $gt_content = json_decode($reponse->getBody()->getContents(), true);
        if($gt_content['status'] != true){
            $error = $gt_content['data'];
            return redirect()->to('kategori')->withErrors($error)->withInput();
        }else {
            return redirect()->to('kategori')->with('success', 'berhasil menghapus data');
        }
    }
}
