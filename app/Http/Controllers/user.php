<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class user extends Controller
{
    function login(Request $request){
        if($request->session()->has('email') || $request->session()->has('phone'))
        {
            return redirect('profile');
        }
        return view('login');
    }



    function signup(Request $request){
        if($request->session()->has('email') || $request->session()->has('phone'))
        {
            return redirect('profile');
        }
        return view('signup');
    }


    function profile(Request $request){

        if($request->session()->has('email') || $request->session()->has('phone'))
        {
            if ($email=$request->session()->get('email')) {
                $result=DB::table('task1')->where('email','=',$email)->get();
                
                foreach ($result as $key => $value) {
                    $data=array('phone'=>'','email'=>$value->email);
                }
            }else{
                $phone=$request->session()->get('phone');
                $result=DB::table('task1')->where('phone','=',$phone)->get();
                foreach ($result as $key => $value) {
                    $data=array('phone'=>$value->phone,'email'=>'');
                }
            }
            
            return view('profile',array('data'=>$data));
        }else{
            $request->session()->flash('error','Access denied');
            return redirect('login');
        }
    }



    function update(Request $request){
        if($request->session()->has('email') || $request->session()->has('phone'))
        {
            if ($email=$request->session()->get('email')) {
                $result=DB::table('task1')->where('email','=',$email)->get();
                
                foreach ($result as $key => $value) {
                    $data=array('phone'=>'','email'=>$value->email);
                }
            }else{
                $phone=$request->session()->get('phone');
                $result=DB::table('task1')->where('phone','=',$phone)->get();
                foreach ($result as $key => $value) {
                    $data=array('phone'=>$value->phone,'email'=>'');
                }
            }
            
            return view('update',array('data'=>$data));
        }else{
            $request->session()->flash('error','Access denied');
            return redirect('login');
        }
    }


    function logout(Request $request){
        echo "logout";
        session()->forget('email');
        session()->forget('phone');
        session()->flash('error','Logout Succesfully');
        return redirect('login');
    }






    function updateFor(Request $request){
        if($request->session()->has('email') && $request->input('submit'))
        { 
            $request->validate([
                'email'=>'required|email|max:100',
                'opass'=>'required|min:5|max:10',
                'npass'=>'required|min:5|max:10' ]);
            $oemail= $request->session()->get('email');
            $email =$request->input('email');
            $opass =$request->input('opass');
            $npass =$request->input('npass');

            if ($oemail!=$email) {
                $check= DB::table('task1')->where('email','=',$email)->exists();
                if ($check==1) {
                    $request->session()->flash('status','Email Already exist');
                    return redirect('update');
                }
            }

            $check= DB::table('task1')->where('email','=',$oemail)->where('pass','=',$opass)->exists();
            if($check==1) {
                $res=DB::table('task1')->where('email','=',$oemail)->update(array(
                    'email'=>$email,'pass'=>$npass));
                if($res==1) {
                    $request->session()->put('email',$email);
                    $request->session()->flash('status','Updated Succesfully');
                    return redirect('update');
                }else{
                    $request->session()->flash('status','Cannot updated');
                    return redirect('update');
                }
            }

        }

        if($request->session()->has('phone') && $request->input('submit'))
        { 
            $request->validate([
                'phone'=>'required|min:10|max:10',
                'opass'=>'required|min:5|max:10',
                'npass'=>'required|min:5|max:10' ]);
                $ophone= $request->session()->get('phone');
                $phone =$request->input('phone');
                $opass =$request->input('opass');
                $npass =$request->input('npass');

            if ($ophone!=$phone) {
                $check= DB::table('task1')->where('phone','=',$phone)->exists();
                if ($check==1) {
                    $request->session()->flash('status','Phone number Already exist');
                    return redirect('update');
                }
            }

            $check= DB::table('task1')->where('phone','=',$ophone)->where('pass','=',$opass)->exists();
            if($check==1) {
                $res=DB::table('task1')->where('phone','=',$ophone)->update(array(
                    'phone'=>$phone,'pass'=>$npass));
                if($res==1) {
                    $request->session()->put('phone',$phone);
                    $request->session()->flash('status','Updated Succesfully');
                    return redirect('update');
                }else{
                    $request->session()->flash('status','Cannot updated');
                    return redirect('update');
                }
            }
        }
}









    function loginCheck(Request $request){

        if($request->input('type')=="email" && $request->input('submit')) {
           
           $request->validate([
                'email'=>'required|email|max:100',
                'pass'=>'required|min:5|max:10' ]);

            $email =$request->input('email');
            $pass =$request->input('pass');
            $doe=date('d-m-y');

            $check= DB::table('task1')->where('email','=',$email)->where('pass','=',$pass)->exists();
            if($check==1) {
                $request->session()->put('email',$email);
                return redirect('profile');
            }else{
                $request->session()->flash('error','Userid Password mismatch');
                return redirect('login');
            }
        }

        if($request->input('type')=="phone" && $request->input('submit')) {
           
           $request->validate([
                'phone'=>'required|max:10',
                'pass'=>'required|min:5|max:10' ]);

            $phone =$request->input('phone');
            $pass =$request->input('pass');
            $doe=date('d-m-y');

            $check= DB::table('task1')->where('phone','=',$phone)->where('pass','=',$pass)->exists();
            if($check==1) {
                $request->session()->put('phone',$phone);
                return redirect('profile');
            }else{
                $request->session()->flash('error','Userid Password mismatch');
                return redirect('login');
            }
        }


    }













    function form_submit(Request $request){

        if($request->input('type')=="email" && $request->input('submit')) {
           
           $request->validate([
                'email'=>'required|email|max:50',
                'pass'=>'required|min:5|max:10' ]);

            $email =$request->input('email');
            $pass =$request->input('pass');
            $doe=date('d-m-y');

            $check= DB::table('task1')->where('email','=',$email)->exists();
            if($check==0) {
                $result=DB::table('task1')->insert(array('email'=>$email,'pass'=>$pass,'doe'=>$doe));
                if ($result==1) {
                    $request->session()->flash('status','Your Account is Created.. Please login here');
                    return redirect('login');
                }
            }else{
                $request->session()->flash('error','The email address is Already in Use!');
                return redirect('signup');
            }
        }


        if($request->input('type')=="phone" && $request->input('submit')) {
           
           $request->validate([
                'phone'=>'required|max:10',
                'pass'=>'required|min:5|max:10']);
            $phone =$request->input('phone');
            $pass =$request->input('pass');
            $doe=date('d-m-y');

            $check= DB::table('task1')->where('phone','=',$phone)->exists();
            if($check==0) {
                $result=DB::table('task1')->insert(array('phone'=>$phone,'pass'=>$pass,'doe'=>$doe));
                if ($result==1) {
                    $request->session()->flash('status','Your Account is Created.. Please login here');
                    return redirect('login');
                }
            }else{
                $request->session()->flash('error','The Phone number is Already in Use!');
                return redirect('signup');
            }
        }



    }







}
