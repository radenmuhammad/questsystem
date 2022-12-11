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
        Schema::create('quests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('misi', 255)->nullable();
            $table->integer('gold_rewards');
            $table->integer('time_limit');			
			$table->timestamp('created_at')->useCurrent();
			$table->timestamp('updated_at')->nullable();	
        });
		
        $data =  array(
            [
                'misi' => 'Play Ball',
				'gold_rewards' => 3,
				'time_limit' => 3
            ],
            [
                'misi' => 'Play Golf',
				'gold_rewards' => 5,
				'time_limit' => 3				
            ],
            [
                'misi' => 'Play Badminton',
				'gold_rewards' => 2,
				'time_limit' => 3						
            ],
        );
        foreach ($data as $datum){
            $user = new App\Models\Quest();
            $user->misi = $datum['misi'];
            $user->gold_rewards = $datum['gold_rewards'];
            $user->time_limit = $datum['time_limit'];
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
        Schema::dropIfExists('quests');
    }
};
