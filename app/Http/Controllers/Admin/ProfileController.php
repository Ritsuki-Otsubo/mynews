<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Profile;

class ProfileController extends Controller
{
    public function add()
    {
        return view('admin.profile.create');
    }


    public function create(Request $request)
    {
        $this->validate($request, Profile::$rules);
      $profile = new Profile;
      $form = $request->all();
      
      // フォームから送信されてきた_tokenを削除する
      unset($form['_token']);
      
      // データベースに保存する
      $profile->fill($form);
      $profile->save();
        
        return redirect('admin/profile/create');
    }
    
    
    public function index(Request $request)
  {
      $cond_name = $request->cond_name;
      if ($cond_name != '') {
          // 検索されたら検索結果を取得する
          $posts = Profile::where('name', $cond_name)->get();
      } else {
          // それ以外はすべてのニュースを取得する
          $posts = Profile::all();
      }
      return view('admin.profile.index', ['posts' => $posts, 'cond_name' => $cond_name]);
  }



    public function edit(Request $request)
    {
           // Profiles Modelからデータを取得する
      $profile = Profile::find($request->id);
      if (empty($profile)) {
        abort(404);    
      }
        return view('admin.profile.edit',['profile_form' => $profile]);
    }
    
    
    public function update()
    {
                    // Validationをかける
      $this->validate($request, Profiles::$rules);
      // Profiles Modelからデータを取得する
      $profile = Profile::find($request->id);
      // 送信されてきたフォームデータを格納する
      $profiles_form = $request->all();
      if ($request->remove == 'true') {
            $profiles_form['image_path'] = null;
        } elseif ($request->file('image')) {
            $path = $request->file('image')->store('public/image');
            $profiles_form['image_path'] = basename($path);
        } else {
            $profiles_form['image_path'] = $profiles->image_path;
        }
      unset($profiles_form['_token']);
      // 該当するデータを上書きして保存する
      $profiles->fill($profiles_form)->save();

        return redirect('admin/profile/edit');
    }
    
     public function delete(Request $request)
  {
      // 該当するNews Modelを取得
      $profile = Profile::find($request->id);
      // 削除する
      $profile->delete();
      return redirect('admin/profile/');
  }
}