<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboarController extends Controller
{
    public function login(){
        return view('login');
    }

    public function dologin(Request $req){
        $email = $req->email;
        $password = $req->password;
        $params = "email=".$email."&"."password=".$password;

        $login = new Client(['http_errors' => false]);
        $url = 'localhost:8000/api/login?'.$params;
        $reponse = $login->request('post', $url, [
            'headers'=>['Content-type'=>'aplication/json'],
        ]);
        $gt_content = json_decode($reponse->getBody()->getContents(), true);
        // print_r($gt_content);
        if($gt_content['status'] != true){
            $error = $gt_content['message'];
            return redirect()->to('login')->withErrors($error)->withInput();
        }else {
            session()->put('login_token',$gt_content['login_token']);
            session()->put('login_data',$gt_content['login_data']);
            return redirect()->to('kategori');
        }
    }

    public function logout(){
        Session::flush();
        $logout = new Client();
        $url = 'localhost:8000/api/logout';
        $reponse = $logout->request('post', $url, [
            'headers'=>['Content-type'=>'aplication/json'],
        ]);
        $gt_content = json_decode($reponse->getBody()->getContents(), true);     

        return redirect()->to('login');

    }
}
