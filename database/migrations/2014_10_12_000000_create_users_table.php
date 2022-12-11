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
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
			$table->timestamp('created_at')->useCurrent();
			$table->timestamp('updated_at')->nullable();	
        });
		
        $data =  array(
            [
                'name' => 'Deni',
				'email' => 'Deni@gmail.com',
				'password' => '123',
            ],
            [
                'name' => 'Raden',
                'email' => 'Raden@gmail.com',
				'password' => '123',
            ],
            [
                'name' => 'Anugrah',
                'email' => 'Anugrah@gmail.com',				
				'password' => '123',
            ],
        );
        foreach ($data as $datum){
            $user = new App\Models\User();
            $user->name = $datum['name'];
            $user->email = $datum['email'];
            $user->password = md5($datum['password']);
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
        Schema::dropIfExists('users');
    }
};
