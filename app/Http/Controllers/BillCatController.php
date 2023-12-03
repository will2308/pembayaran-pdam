<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class BillCatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = new Client();
        $url = 'localhost:8000/api/bill_cat';
        $reponse = $kategori->request('get', $url);
        $gt_content = json_decode($reponse->getBody()->getContents(), true);
        $data = $gt_content['data'];
        // echo $gt_content;
        // print_r($data);
        return view('content.bill_cat', ['data'=> $data]);
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
            'headers'=>['Content-type'=>'aplication/json'],
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
        // $kategori = new Client();
        // $url = 'localhost:8000/api/bill_cat/'.$id;
        // $reponse = $kategori->request('get', $url);
        // $gt_content = json_decode($reponse->getBody()->getContents(), true);
        // // print_r($gt_content);
        // // echo $url;
        // if($gt_content['status'] != true){
        //     $error = $gt_content['message'];
        //     return redirect()->to('kategori')->withErrors($error);
        // }else {
        //     $data = $gt_content['data'];
        //     return view('content.bill_cat', ['data'=> $data]);
        // }


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
            'headers'=>['Content-type'=>'aplication/json'],
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
            'headers'=>['Content-type'=>'aplication/json'],
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kategori = new Client();
        $url = 'localhost:8000/api/bill_cat/'.$id;
        $reponse = $kategori->request('delete', $url);
        $gt_content = json_decode($reponse->getBody()->getContents(), true);
        if($gt_content['status'] != true){
            $error = $gt_content['data'];
            return redirect()->to('kategori')->withErrors($error)->withInput();
        }else {
            return redirect()->to('kategori')->with('success', 'berhasil menghapus data');
        }
    }
}
