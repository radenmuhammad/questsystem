<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestController;
use App\Http\Controllers\UsersInformationController;
use App\Http\Controllers\ProgressInformationController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// 
//Route::resource('progressinformation',ProgressInformationController::class);
// API to add the users
Route::post('/addUser', [UsersInformationController::class, 'add_user']);
// API to select the users
Route::get('/selectUsers', [UsersInformationController::class, 'select_users']);
// API to complete the mission: param => user_id,quests_id
Route::post('/completeMission', [UsersInformationController::class, 'completeMission']);
// API to view completed missions
Route::get('/seeCompleteMission', [UsersInformationController::class, 'seeCompleteMission']);
// API to see the progress of a mission param => user_id, quests_id
Route::post('/seeMissionProgress', [UsersInformationController::class, 'seeMissionProgress']);
// API to add the Mission Progress
Route::post('/addMissionProgress', [UsersInformationController::class, 'addMissionProgress']);
// API to take on the new mission param => user_id, misi, gold_rewards, time_limit
Route::post('/takeTheNewMission', [UsersInformationController::class, 'takeTheNewMission']);
// API to show the user/player informations on any missions & how much gold they have
Route::get('/show_user_or_player_informations', [UsersInformationController::class, 'show_user_or_player_informations_and_how_much_they_have_golds']);



//Route::resource('usersinformation',UsersInformationController::class);
Route::resource('quests',QuestController::class);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
?>
