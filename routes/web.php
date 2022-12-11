<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/View_Mission_Progress/{user_id}/{quests_id}', function ($user_id,$quests_id) {
    return view('view_mission_progress')->with('user_id',$user_id)->with('quests_id',$quests_id);
});

Route::get('/new_mission', function()  
{  
    return view('new_mission');
}); 

Route::get('/new_user', function()  
{  
    return view('new_user');
}); 

Route::get('/add_mission_progress/{user_id}/{quests_id}', function ($user_id,$quests_id) { 
    return view('add_mission_progress')->with('user_id',$user_id)->with('quests_id',$quests_id);
});  
