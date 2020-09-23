<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
  //NewsControllerに、addというActionを実装(Routing未設定)
  public function add()
  {
    return view('admin.news.create');
  }
}
