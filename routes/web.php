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
//socket.io demo
Route::get('socket', 'SocketController@index');
Route::post('sendmessage', 'SocketController@sendMessage');
Route::get('writemessage', 'SocketController@writemessage');

//searchable
Route::get('find', 'SearchController@find');

Route::get('search/{pollId?}/{createdAt?}', [
    'as' => 'link-search',
    'uses' => 'LinkController@create'
]);

Route::group(['middleware' => 'XSS'], function() {
    Route::post('user-register', [
        'as' => 'user-register',
        'uses' => 'User\UsersController@store'
    ]);

    Route::post('user-login', [
        'as' => 'user-login',
        'uses' => 'User\LoginController@store'
    ]);

    Route::resource('user-poll', 'PollController');
    Route::resource('duplicate', 'DuplicateController');

    /*
     * Route check token of link
     */
    Route::resource('link-poll', 'LinkController', ['only' => [
        'store'
    ]]);


    /*
     * Route change status of poll
     */
    Route::resource('status', 'StatusController', ['only' => [
        'store'
    ]]);

    /*
     * Route check limit of poll
     */
    Route::resource('limit', 'LimitController', ['only' => [
        'store'
    ]]);

    Route::get('/', 'PollController@create');

    Route::resource('result-poll', 'ResultCreatePollController', ['only' => [
        'show'
    ]]);

    Route::get('check-date-close-poll', 'User\CheckDateController@checkDateClosePoll');
});



Route::post('link/{token?}', [
    'as' => 'link',
    'uses' => 'LinkController@index'
]);

Route::get('link/verification/{tokenRegister?}', 'LinkController@index');

Route::post('check-email', 'CheckEmailController@store');

Route::get('/logout', function()
{
    Auth::logout();
    Session::flush();
    return Redirect::to('/');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'user', 'middleware' => 'auth'], function() {
    Route::resource('profile', 'User\UsersController', [
        'only' => ['index', 'update']
    ]);
});

Route::group(['prefix' => 'user', 'middleware' => 'XSS'], function() {
    Route::resource('poll', 'User\PollController', [
        'except' => ['show']
    ]);

    Route::resource('comment', 'User\CommentController', [
        'only' => ['store', 'destroy']
    ]);

    Route::resource('vote', 'User\VoteController', [
        'only' => ['store', 'destroy']
    ]);

    Route::resource('activity', 'User\ActivityController', [
        'only' => ['show']
    ]);

    Route::resource('set-password', 'User\SetPasswordController', [
        'only' => ['store']
    ]);
});

Route::post('exportPDF', [
    'as' => 'exportPDF',
    'uses' => 'User\ExportController@exportPDF'
]);

Route::post('exportExcel', [
    'as' => 'exportExcel',
    'uses' => 'User\ExportController@exportExcel'
]);

Route::post('delete-all-participant', [
    'as' => 'delete_all_participant',
    'uses' => 'User\ParticipantController@deleteAllParticipant'
]);

Route::get('load-initiated-poll', 'User\LoadPollsController@loadInitiatedPolls');

Route::get('load-participanted-in-poll', 'User\LoadPollsController@loadParticipantedPolls');

Route::get('load-closed-poll', 'User\LoadPollsController@loadClosedPolls');

Route::get('link/{token?}', 'LinkController@show');

Route::resource('language', 'User\LanguageController', [
    'only' => ['store']
]);

Route::get('/redirect/{provider}', 'SocialAuthController@redirectToProvider');
Route::get('/callback/{provider}', 'SocialAuthController@handleProviderCallback');

/*
 /--------------------------------------------------------------------
 / Route Admin
 /--------------------------------------------------------------------
 */
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'as' => 'admin.','middleware' => 'admin'], function () {
    Route::resource('poll', 'PollController', ['except' => [
        'show'
    ]]);
    Route::resource('user', 'UserController', ['except' => [
        'show'
    ]]);
});

Route::get('tutorial', function () {
    $filename = 'Fpoll.pdf';
    $path = public_path(). '/file/'.$filename;

    return Response::make(file_get_contents($path), 200, [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'inline; filename="'.$filename.'"'
    ]);
});

