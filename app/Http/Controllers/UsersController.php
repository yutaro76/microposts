<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class UsersController extends Controller
{
    
    public function index() {
    
        $users = User::orderBy('id', 'desc')->paginate(5);
        
        return view('users.index', ['users' => $users,]);
        
    }
    
    public function show($id) {
        
        $user = User::findOrFail($id);
        
        $user->loadRelationshipCounts();
        
        $microposts = $user->microposts()->orderBy('created_at', 'desc')->paginate(5);
        
        return view('users.show', ['user' => $user, 'microposts' => $microposts,]);
        
    }
    
    public function followings($id) {
        $user = User::findOrFail($id);
        
        $user->loadRelationshipCounts();
        
        $followings = $user->followings()->paginate(5);
        
        return view('users.followings', [
            'user' => $user,
            'users' => $followings,
        ]);
    }
    
    public function followers($id) {
        $user = User::findOrFail($id);
        
        $user->loadRelationshipCounts();
        
        $followers = $user->followers()->paginate(5);
        
        return view('users.followers', [
            'user' => $user,
            'users' => $followers,
        ]);
    }
    
    public function favorites($id) 
    {
        $user = User::findOrFail($id);
        
        $user->loadRelationshipCounts();
        
        $favorites = $user->favorites()->paginate(5);
        
        return view('users.favorites', [
            'user' => $user,
            'microposts' => $favorites,
            ]);
    }
    
    public function deletePage($id)
    {
        $user = User::findOrFail($id);
        
        return view('users.delete', [
            'user' => $user,
            ]);
    }
    
    public function deleteAccount($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        
        return redirect('/');
    }
}
