<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests;

use App\User;
use App\Elan;
use App\Admin;
use Auth;


class AdminController extends Controller
{
  //========================For Admin Login===========================
  public function login()
  {
     return view('admin.admin_login');
  }

  public function postLogin(Request $request)
  {
    $email = $request->email;
    $password = md5($request->password);
    $validator= validator($request->all(), [
      'email' => 'required|min:3|max:100',
      'password' => 'required|min:3|max:100',
  ]);

    if ($validator->fails() ) {
        return redirect('/alfagen/login')
                ->withErrors($validator)
                ->withInput();
    }
    if (isset($_SESSION))
    {
      $admins = Admin::all();
      foreach ($admins as $admin) {
        if ($admin->email == $email && $admin->password == $password) {
          $_SESSION['admin'] = 'admin';
          return redirect('/alfagen');
        }else {
          return redirect('/alfagen/login')
                  ->withErrors(['errors' => 'Duzgun deyl!'])
                  ->withInput();
        }
      }
    }
    else
    {
      session_start();
      // return redirect('/alfagen/login')
      //         ->withErrors(['errors' => 'Duzgun deyl!'])
      //         ->withInput();
    }
  }
  public function logout()
    {
      unset($_SESSION['admin']);
      auth()->guard('admin')->logout();
      return redirect('/alfagen/login');
    }
  //========================For Admin Login End=======================
    public function index()
    {
      $users = User::orderBy('created_at','desc')->paginate(8);
      $istek_count = Elan::where('type_id', 2);
      $destek_count = Elan::where('type_id', 1);
      return view('admin.index',compact('users','istek_count','destek_count'));
    }

    public function istek_list()
    {
      $istekler=Elan::orderBy('created_at','desc')->paginate(8);
      return view('admin.istek_list',compact('istekler'));
    }

    public function destek_list()
    {
      $destekler=Elan::orderBy('created_at','desc')->paginate(8);
      return view('admin.destek_list',compact('destekler'));
    }

    public function activate($id)
    {
      $status=Elan::find($id);
      $status->status='1';
      $status->save();
      return back();
    }

    public function deactivate($id)
    {
      $status=Elan::find($id);
      $status->status='0';
      $status->save();
      return back();
    }
}
