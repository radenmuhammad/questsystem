<?php

namespace App\Http\Controllers;

use App\Models\UsersInformation;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class UsersInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }
	
	public function select_users(){
		$users = DB::table('users')
				->select('users.id', 
				         'users.name')
				->get(); 
        return [
            "status" => 1,
            "data" => $users
        ];					
	}
	
	public function add_user(Request $request){
		$request_all=$request->all();		
		DB::table('users')->insertGetId(
			['name' => $request_all['name'],'email' => $request_all['email'],'password' => md5($request_all['password'])]
		);				
	}

    public function show_user_or_player_informations_and_how_much_they_have_golds()
    {
		$users = DB::table('users_information')
				->select('users.id', 
				         'users.name', 
				         'users.email', 
						 DB::raw('group_concat(quests.id) as misi_id'),
						 DB::raw('group_concat(quests.misi) as misi'),
						 DB::raw('CONCAT(group_concat(users_information.complete_mission),",") as status_mision'),
						 DB::raw('SUM(IF(users_information.complete_mission = 1, quests.gold_rewards, 0)) AS total_gold_rewards'), 
						 
						 )
				->leftJoin('users','users.id','=','users_information.user_id')
				->leftJoin('quests', 'quests.id', '=', 'users_information.quests_id')
				->groupBy('users.id','users.name', 'users.email')
				->orderBy('users.created_at', 'DESC')				
				->get();				
        return [
            "status" => 1,

            "data" => $users
        ];			
	}
	
    public function seeCompleteMission()
    {
		$users = DB::table('users_information')
				->select('users.id', 
				         'users.name', 
				         'users.email', 
						 DB::raw('group_concat(quests.id) as misi_id'),
						 DB::raw('group_concat(quests.misi) as misi'),
						 DB::raw('SUM(quests.gold_rewards) AS total_gold_rewards'), 
						 
						 )
				->where('users_information.complete_mission','=','1')		 
				->leftJoin('users','users.id','=','users_information.user_id')
				->leftJoin('quests', 'quests.id', '=', 'users_information.quests_id')
				->groupBy('users.id','users.name', 'users.email')
				->orderBy('users.created_at', 'DESC')				
				->paginate(10);				
       return [
            "status" => 1,
            "data" => $users
        ];
    }

    public function seeMissionProgress(Request $request)
    {
		$request_all=$request->all();		
		$users = DB::table('progress_information')
				->select('progress_information.progress_information_name')
				->where('progress_information.user_id','=',$request_all['user_id'])		 
				->where('progress_information.quests_id','=',$request_all['quests_id'])
				->paginate(10);				
       return [
            "status" => 1,
            "data" => $users
        ];
    }
	
	public function takeTheNewMission(Request $request){
		$request_all=$request->all();			
		$quests_id = DB::table('quests')->insertGetId(
			['misi' => $request_all['misi'], 'gold_rewards' => $request_all['gold_rewards'],'time_limit' => $request_all['time_limit'],'created_at' => Carbon::now()]
		);		
		// users_information
		$id = DB::table('users_information')->insertGetId(
			['user_id' => $request_all['user_id'], 'quests_id' => $quests_id, 'complete_mission' => 0,'created_at' => Carbon::now()]
		);	
       return [
            "status" => 1,
            "data" => ['user_id' => $request_all['user_id'], 'quests_id' => $quests_id, 'misi' => $request_all['misi'], 'gold_rewards' => $request_all['gold_rewards'],'time_limit' => $request_all['time_limit']]
        ];		
	}
	
	public function addMissionProgress(Request $request){
		$request_all=$request->all();			
		DB::table('progress_information')->insertGetId(
			['user_id' => $request_all['user_id'], 'quests_id' => $request_all['quests_id'],'progress_information_name' => $request_all['progress_information_name']]
		);		
	}
	
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function completeMission(Request $request)
	{
		$request_all=$request->all();
		DB::table('users_information')
		->where('user_id',$request_all['user_id'])
		->where('quests_id',$request_all['quests_id'])
		->update([
			'complete_mission' => 1,
		]);		
	}	 
	 
    public function store(Request $request)
    {

        $userinformations = UsersInformation::create($request->all());
        return [
            "status" => 1,
            "data" => $userinformations
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(UsersInformation $userinformations)
    {
        return [
            "status" => 1,
            "data" =>$userinformations
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(UsersInformation $userinformations)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UsersInformation $usersinformations)
    {

        $usersinformations->update($request->all());

        return [
            "status" => 1,
            "data" => $usersinformations,
            "msg" => "The User Informations is updated successfully"
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(UsersInformation $usersinformations)
    {
        $usersinformations->delete();
        return [
            "status" => 1,
            "data" => $usersinformations,
            "msg" => "The User Informations is deleted successfully"
        ];
    }
}

?>