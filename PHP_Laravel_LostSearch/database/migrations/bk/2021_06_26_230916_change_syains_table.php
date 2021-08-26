<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeSyainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     //�ύX����ꍇ
    public function up()
    {
        Schema::table('syains', function (Blueprint $table) {
            $table->renameColumn('id', 'syain_id');
            });
            
            
            
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     //���ɖ߂��ꍇ
    public function down()
    {
                Schema::table('syains', function (Blueprint $table) {
            $table->renameColumn('syain_id', 'id');
             });

    }
}
