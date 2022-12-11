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
        Schema::create('progress_information', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->unsignedBigInteger('user_id');
			$table->foreign('user_id')->references('id')->on('users');			
			$table->unsignedBigInteger('quests_id');
			$table->foreign('quests_id')->references('id')->on('quests');			
            $table->string('progress_information_name');			
			$table->timestamp('created_at')->useCurrent();
			$table->timestamp('updated_at')->nullable();	
        });
        $data =  array(
            [
				'user_id' => 3,
				'quests_id' => 1,
                'progress_information_name' => 'Start Mission',
            ],
            [
				'user_id' => 3,
				'quests_id' => 1,				
                'progress_information_name' => 'Start Mission 2',
            ],
            [
				'user_id' => 3,
				'quests_id' => 2,				
                'progress_information_name' => 'Completed Mission',
            ],
            [
				'user_id' => 3,
				'quests_id' => 3,				
                'progress_information_name' => 'Completed Mission',
            ]
        );
        foreach ($data as $datum){
            $user = new App\Models\ProgressInformation();
            $user->user_id = $datum['user_id'];
            $user->quests_id = $datum['quests_id'];
            $user->progress_information_name = $datum['progress_information_name'];
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
        Schema::dropIfExists('progress_information');
    }
};
