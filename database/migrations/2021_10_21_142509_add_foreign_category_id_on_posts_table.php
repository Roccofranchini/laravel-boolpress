<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignCategoryIdOnPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            //definiamo la colonna da aggiungere, posizionata dopo la colonna after e settata nullable

            //$table->unsignedBigInteger('category_id')->after('id')->nullable();

            //definiamo la foreign key nella colonna  foreign_key, che si riferisce appunto all'id dellaa tabella categories
            //$table->foreign('cetegory_id')->references('id')->on('categories')

            //OPPURE IN FORMA RISTRETTA

            $table->foreignId('category_id')->after('id')->nullable()->onDelete('set null')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            // eliminiamo il vincolo del foreign
            $table->dropForeign('posts_category_id_foreign');

            //eliminiamo la colonna
            $table->dropColumn('category_id');



        });
    }
}
