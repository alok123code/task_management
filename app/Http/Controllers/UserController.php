<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    /** *************** For the all admin Users Show Start**************** */
    // public function index()
    // {
        
    //     $users = User::paginate(7);
    //     return view('admin.User.userList',compact('users'));
    // }
    /** *************** For the all admin Users Show End **************** */
    /**
     * Show the form for creating a new resource.
     */
    /** *************** For the  admin Users Create Start **************** */

    // public function create()
    // {
        
    //    return view('admin.User.addUser');
    // }

    /** *************** For the  admin Users Create End **************** */

    /** *************** For the  admin Users Store Start **************** */
    /**
     * Store a newly created resource in storage.
     */

    // public function store(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         "name" => "required",
    //         "email" => "required|email|unique:users",
    //         "phoneNo" => "required|numeric|unique:users",
    //         "password" => "required|min:6",
    //     ]);
    //     // if any validation failed then it occurs
    //     if ($validator->fails()) {
    //         $errorsArray = $validator->errors()->toArray();

    //         $error = [];
    //         foreach($errorsArray as $key => $val){
    //               $error[] = $key;
    //         }
    //         $message = implode(' and ',$error);
    //         return redirect('users/create')->with('error', 'The '. $message . ' should be unique.');
    //     }
    //     $user = new User();

    //     $user->name = $request->name;
    //     $user->email = $request->email;
    //     $user->phoneNo = $request->phoneNo;
    //     $user->password = Hash::make($request->password);
    //     if ($user->save()) {
    //         // Set success flash message
    //         return redirect('users')->with('success', 'User Created SuccesFully');
    //     } else {
    //         // Set error flash message
    //         return redirect('users/create')->with('error', 'Failed!!! Please try again.');
    //     }
    // }
   
    /** *************** For the  admin Users Create End **************** */

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     if($id){
    //         $user = User::find($id);
    //         if($user){
    //             return view('admin.User.profileUser',compact('user'));
    //         }else{
    //             return redirect()->route('users.index')->with('error', 'User not found please try again!.');
    //         }
    //     }else{
    //         return redirect()->route('users.index')->with('error', 'User id not found please try again!.');
    //     }
    // }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(string $id)
    // {
        
    //     if($id){
    //         $user = User::find($id);
    //         if($user){
    //             return view('admin.User.updateUser', compact('user'));
    //         }else{
    //             return redirect('users')->with('error', 'User not found! Please try again.');
    //         }
    //     }else{
    //         return redirect('users')->with('error', 'User id not found! Please try again.');
    //     }
        
        
    // }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, string $id)
    // {
    //     $validator = Validator::make($request->all(), [
    //         "name" => "required",
    //         "email" => "required|email|unique:users,email," . $id,
    //         "phoneNo" => "required|numeric|unique:users,phoneNo," . $id,
    //         "password" => "required|min:6",
    //     ]);
    
    //     // If validation fails, redirect back with errors
    //     if ($validator->fails()) {
    //         $errorsArray = $validator->errors()->toArray();
    
    //         $error = [];
    //         foreach ($errorsArray as $key => $val) {
    //             $error[] = $key;
    //         }
    //         $message = implode(' and ', $error);
    //         return redirect()->route('users.edit', $id)->with('error', 'The ' . $message . ' should be unique.');
    //     }
    
    //     if ($id) {
    //         $user = User::find($id);
    //         if ($user) {
    //             $user->name = $request->name;
    //             $user->email = $request->email;
    //             $user->phoneNo = $request->phoneNo;
    //             $user->password = Hash::make($request->password);
    
    //             if ($user->save()) {
    //                 return redirect()->route('users.index')->with('success', 'User updated successfully.');
    //             } else {
    //                 return redirect()->route('users.edit', $id)->with('error', 'User could not be saved. Please try again.');
    //             }
    //         } else {
    //             return redirect()->route('users.edit', $id)->with('error', 'User not found. Please try again.');
    //         }
    //     } else {
    //         return redirect()->route('users.edit', $id)->with('error', 'User ID not found. Please try again.');
    //     }
    // }
    

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(string $id)
    // {
    //    if($id){
    //       $isDeleted = User::destroy($id);
    //       if($isDeleted){
    //         return redirect('users');
    //       }
    //       else{
    //         return redirect('users')->with('error', 'Failed!!! Please try again.');
    //       }
    //    }else{
    //     return redirect('users')->with('error', 'Failed! Please try again. User id not matched!');
    //    }
    // }
    
    public function showloginForm(){
        // echo "<pre>"; print_r("Hello i am"); die;
       return view('admin.User.login');
    }
    public function login(Request $req){
        // echo "<pre>"; print_r("HEllo"); die;
        $req->validate([
            "email" => "required",
            "password" => "required|min:6",
        ]);
        
        $email = $req->email;
        $password = $req->password;

        $user = User::where('email',$email)->first();
        
        if($user && Hash::check($password, $user->password)){
            Auth::login($user); 
            return view('admin.dashboard');
        }elseif($user && !(Hash::check($password, $user->password))){
            return redirect('/login')->with('error', 'The password does not match our records.');
        }
        else{
            return redirect('/login')->with('error', 'The email does not exist in our records please go to signup page!.');
        }

    }
    public function logout(){
        Auth::logout();
        return redirect('/login')->with('success', 'Logout Successfully!.');;
    }

    public function showForm(){
        return view ('admin.User.registerUser');
    }
    public function register(Request $req){

        
        $validator = Validator::make($req->all(), [
            "name" => "required",
            "email" => "required|email|unique:users",
            "phoneNo" => "required|numeric|unique:users",
            "password" => "required|min:6",
        ]);
    
        // if any validation failed then it occurs
        if ($validator->fails()) {
            $errorsArray = $validator->errors()->toArray();

            $error = [];
            foreach($errorsArray as $key => $val){
                  $error[] = $key;
            }
            $message = implode(' and ',$error);
            return redirect('/register')->with('error', 'The '. $message . ' should be unique.');
        }
        

        $user = new User();

        $user->name = $req->name;
        $user->email = $req->email;
        $user->phoneNo = $req->phoneNo;
        $user->password = Hash::make($req->password);
        if ($user->save()) {
            // Set success flash message
            return redirect('/login')->with('success', 'Registration successful! Please log in.');
        } else {
            // Set error flash message
            return redirect('/register')->with('error', 'Registration failed. Please try again.');
        }
    }
}
