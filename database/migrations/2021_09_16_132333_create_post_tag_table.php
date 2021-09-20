<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_tag', function (Blueprint $table) {
          // $table->id();
          // $table->timestamps();

          $table->unsignedBigInteger('post_id');
          
          // la chiave post_id fa riferimento ad id nella tabella posts 
          $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');


          $table->unsignedBigInteger('tag_id');
          // la chiave tag_id fa riferimento ad id nella tabella tags 
          $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
          $table->primary(['post_id','tag_id']); //definisco i due id come PK 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_tag');
    }
}



// <?php

// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;
// // tabella pivot 
// class CreatePostTable extends Migration
// {
//     /**
//      * Run the migrations.
//      *
//      * @return void
//      */
//     public function up()
//     {
//         Schema::create('post', function (Blueprint $table) {
//           // $table->id();
//           // $table->timestamps();

//           $table->unsignedBigInteger('post_id');
          
//           // la chiave post_id fa riferimento ad id nella tabella posts 
//           $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');


//           $table->unsignedBigInteger('tag_id');
//           // la chiave tag_id fa riferimento ad id nella tabella tags 
//           $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
//           $table->primary(['post_id','tag_id']); //definisco i due id come PK 
        
//         });
//     }

//     /**
//      * Reverse the migrations.
//      *
//      * @return void
//      */
//     public function down()
//     {
//         Schema::dropIfExists('post');
//     }
// }
