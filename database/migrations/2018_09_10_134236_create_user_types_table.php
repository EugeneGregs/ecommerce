<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\User_type;

class CreateUserTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_type');
            $table->timestamps();
        });

        //insert default values
       DB::table('user_types')->insert(
           array(
               array('user_type' => 'Admin'),
               array('user_type' => 'Buyer'),
               array('user_type' => 'Seller')
           )
       );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_types');
    }
}
