<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get(Lang::get('route.about_me'), 'Controller@main');

Route::get(Lang::get('route.bee'), 'BeeController@main');
Route::get(Lang::get('route.beeShow'), 'BeeController@show')->name('beeShow');
Route::post(Lang::get('route.beeSearch'), 'BeeController@beeSearch')->name('beeSearch');
Route::get(Lang::get('route.beeMonth'), 'BeeController@beeMonth')->name('beeMonth');

Route::post(Lang::get('route.comments'), 'CommentsController@store')->name('comments');

Route::get(Lang::get('route.wine'), 'WineController@main');
Route::get(Lang::get('route.wineShow'), 'WineController@show')->name('wineShow');
Route::post(Lang::get('route.wineSearch'), 'WineController@wineSearch')->name('wineSearch');
Route::get(Lang::get('route.wineMonth'), 'WineController@wineMonth')->name('wineMonth');

Route::get(Lang::get('route.cv'), 'CVController@main');

Route::get(Lang::get('route.contact'), 'ContactController@main');
Route::post(Lang::get('route.contact'), function(\Illuminate\Http\Request $request, \Illuminate\Mail\Mailer $mailer) {
    $rules = array(
        'email' => 'required|email',
        'subject' => 'required|min:3',
        'message' => 'required|min:10',
    );
    $validator = Validator::make($request->all() , $rules);
    if($validator->fails()) {
        return Redirect::to(Lang::get('route.contact'))
            ->withErrors($validator)
            ->withInput($request->input());
    } else {
        $mailer
            ->to('gmorgas@grzegorzmorgas.pl')
            ->send(new \App\Mail\Contact($request->input('email'), $request->input('subject'), $request->input('message')));

        Session::flash('success', Lang::get('contact.success'));
        return redirect()->back();
    }
});

Route::get(Lang::get('route.adminPanel'), 'AdminController@main')->name('admin')->middleware('auth');
Route::get(Lang::get('route.adminCreate'), 'AdminController@create')->middleware('auth');
Route::post(Lang::get('route.adminStore'), 'AdminController@store')->name('store')->middleware('auth');
Route::get(Lang::get('route.adminShow'), 'AdminController@show')->name('show')->middleware('auth');
Route::get(Lang::get('route.adminEdit'), 'AdminController@edit')->name('edit')->middleware('auth');
Route::post(Lang::get('route.adminUpdate'), 'AdminController@update')->name('update')->middleware('auth');
Route::delete(Lang::get('route.adminDelete'), 'AdminController@destroy')->name('delete')->middleware('auth');



Auth::routes();

Route::get('/home', 'HomeController@index');
