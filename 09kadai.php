//課題３
Route::get('/xxx', 'XXX\AAAController@bbb');

//課題４
Route::group(['prefix' => 'admin'], function() {
    Route::get('profile/create', 'Admin\ProfileController@add');
    Route::get('profile/edit', 'Admin\ProfileController@edit');
});