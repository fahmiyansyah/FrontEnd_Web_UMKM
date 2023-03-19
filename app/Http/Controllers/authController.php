<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Laravel\Socialite\Facades\Socialite;

class authController extends Controller
{
    function index(){
        return view('auth.login');
    }
    function redirect(){
        return Socialite::driver('google')->redirect();
    }
    
    function callback(){
        $user = Socialite::driver('google')->user();
        $id = $user->id;
        $email = $user->email;
        $name = $user->name;
        $avatar=$user->avatar;
        $cek = User::where('email', $email)->count();
        if($avatar!=null||$avatar!=null){
            $avatar_file = $id. ".jpg";
            $fileContent = file_get_contents($avatar);
            File::put (public_path("template/images/faces/$avatar_file"), $fileContent);
        }else{
            $avatar='tidakada.jpg';    
        }
        if($name!=null||$name!=''){
            $name=$name; 
        }else{
            $name='tanpa nama';
        }
        if($cek > 0) {
            $user = User::updateOrCreate(['email'=>$email],[
                'name'=>$name,
                'google_id'=>$id,
                'avatar'=>$avatar_file
        
            ]);
            Auth::login($user);
            return redirect()->to('dasboard') ;
        }else{
            $user = User::create(['email'=>$email],[
                'name'=>$name,
                'google_id'=>$id
    
            ]);
        }
        

    }  
    public function logout()
    {
        Auth:: logout();
        return redirect()->to('auth');
    }
}
