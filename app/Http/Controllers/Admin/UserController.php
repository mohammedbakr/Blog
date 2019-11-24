<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->hasAnyRole('admin')){

        return view('admin.users.index')->with('users', User::paginate(5));

        }else{

            return redirect()->route('dashboard');
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->hasAnyRole('admin')){

            $user = User::find($id);
            $roles = Role::all();

            return view('admin.users.edit', compact('user', 'roles'));

        }else{

            return redirect()->route('dashboard');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $request->validate([

           'name' => 'required',
           'email' => 'required|email',
           'image' => 'image|mimes:jpeg,png,jpg,gif,svg,bmp,webp|max:2048'
       ]);

       $user = User::find($id);

       $user->name = $request->input('name');
       $user->email = $request->input('email');

       if($request->hasFile('image')){
           $file = $request->file('image');
           $extension = $file->getClientOriginalExtension(); // getting image extension
           $filename = time() . '.' . $extension;
           $file->move('uploads/profilepics/', $filename);
           $user->image = $filename;

       }

       $user->update();

       $user->roles()->sync($request->roles);
       

       return redirect()->route('admin.users.index')->with('success', "$user->name has been updated successfully");
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if($user->hasAnyRole('admin')){

            return redirect()->route('admin.users.index')->with('error', "This user can't be deleted");

        }

        $user->roles()->detach();
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', "User has been deleted successfully");
    }
}
          