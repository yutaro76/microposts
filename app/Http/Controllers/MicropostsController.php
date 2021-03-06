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
            $microposts = $user->feed_microposts()->orderBy('created_at', 'desc')->paginate(5);

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
    
    public function edit($id) {
        
        $micropost = \App\Micropost::findOrFail($id);
        
        $path = str_replace(url('/'), '', request()->headers->get('referer'));
        
        if (\Auth::id() === $micropost->user_id) {
        
            return view('microposts.edit', [
                'micropost' => $micropost,
                'path' => $path,
                ]);
        }
        
        
        
       
        
    }
    
    public function update(Request $request, $id)
    {
        $micropost = \App\Micropost::findOrFail($id);
        
        $micropost->content = $request->content;
        $micropost->save();
       
        $path = $request->path;
        
        if($path == '/') {
            
            return redirect('/'); 
            
        } elseif ($path == '/users/' . \Auth::id()) {
            
            return redirect('/users/' . \Auth::id());
            
        } else {
            
            return redirect('/users/' . \Auth::id() . '/favorites');
            
        }
    }
    
    
}



//ホーム
//

//タイムライン
// users/user_id

//favorite
//users/user_id/favorites



