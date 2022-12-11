<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_information', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->unsignedBigInteger('user_id');
			$table->foreign('user_id')->references('id')->on('users');
			$table->unsignedBigInteger('quests_id');
			$table->foreign('quests_id')->references('id')->on('quests');
			$table->unsignedBigInteger('complete_mission');
			$table->timestamp('created_at')->useCurrent();
			$table->timestamp('updated_at')->nullable();			
		});
        $data =  array(
            [
                'user_id' => 3,
				'quests_id' => 1,
				'complete_mission' => 0
            ],
            [
                'user_id' => 3,
				'quests_id' => 2,
				'complete_mission' => 1
            ],
            [
                'user_id' => 3,
				'quests_id' => 3,
				'complete_mission' => 1
            ],
        );
        foreach ($data as $datum){
            $user = new App\Models\UsersInformation();
            $user->user_id = $datum['user_id'];
            $user->quests_id = $datum['quests_id'];
            $user->complete_mission = $datum['complete_mission'];
            $user->save();
        }				
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_information');
    }
};
