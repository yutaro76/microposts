<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MicropostsController extends Controller
{
   public function index()
    {
        $data = [];
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザを取得
            $user = \Auth::user();
            // ユーザの投稿の一覧を作成日時の降順で取得
            // （後のChapterで他ユーザの投稿も取得するように変更しますが、現時点ではこのユーザの投稿のみ取得します）
            $microposts = $user->microposts()->orderBy('created_at', 'desc')->paginate(5);

            $data = [
                'user' => $user,
                'microposts' => $microposts,
            ];
        }

        // Welcomeビューでそれらを表示
        return view('welcome', $data);
    }
    
    public function store(Request $request)
    {
        $request->validate(['content' => 'required|max:255',]);
        
        $request->user()->microposts()->create(['content' => $request->content,]);
        
        return back();
    }
    
    public function destroy($id) 
    {
        $micropost = \App\Micropost::findOrFail($id);
        
        if (\Auth::id() === $micropost->user_id) {
            $micropost->delete();
        }
        
        return back();
        
    }
    
    
}
