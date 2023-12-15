<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class CreateMoreUserInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    var $ts_init_val;
    
    public function __construct()
    {
        $this->ts_init_val = Carbon::now();
    }
    
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('more_user_info', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
        //    $table->smallInteger('int_country_id')->default(0);
       //     $table->smallInteger('int_language_id')->default(0);
        //    $table->smallInteger('int_timezone_id')->default(0);
           
        //    $table->boolean('bool_usa_address')->default(1);
            $table->integer('int_salutation_id')->nullable();
            $table->string('str_first_name')->nullable();
            $table->string('str_last_name')->nullable();
            $table->string('str_user_name')->nullable();
       //     $table->string('str_cellphone')->nullable();
        //    $table->boolean('bool_has_email')->default(0);
        //    $table->boolean('bool_has_cellphone')->default(0);
       //     $table->boolean('bool_verified_by_email')->default(0);
       //     $table->boolean('bool_verified_by_cellphone')->default(0);
            //    $table->string('str_telephone_one')->nullable();
        //    $table->string('str_telephone_two')->nullable();
         //   $table->string('str_address_one')->nullable();
         //   $table->string('str_address_two')->nullable();
       
            $table->timestamp('ts_user_last_login')->nullable();
            $table->timestamp('ts_user_current_login')->default($this->ts_init_val);
          //  $table->string('str_last_intended_page')->nullable();
            
            
            $table->timestamps();
        });
        
            
            Schema::table(
                'more_user_info',
                function (Blueprint $table)
                {
                    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
              //      $table->foreign('user_id')->references('id')->on('users');
                }
            );
            
            Schema::table(
                'more_user_info',
                function (Blueprint $table)
                {
                    $table->index('user_id');
                }
            );
            
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::table(
            'more_user_info',
            function (Blueprint $table)
            {
                $table->dropForeign('more_user_info_user_id_foreign');
                $table->dropIndex('more_user_info_user_id_index');
        }
        );
        
        Schema::dropIfExists('more_user_info');
    }
}
