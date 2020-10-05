<?php
//Validation...データの不備をあらかじめ防ぐために検証する仕組み

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    //入力によって変動する値を安全に管理する
    protected $guarded = array('id');
    //リクエストを受け取ってデータベースに保存する且つリクエストに応じて変わらないとは、インスタンス化の有無に関わらずプロパティが変化しないこと
    public static $rules = array(
        'title' => 'required',
        'body' => 'required',
    );
}
