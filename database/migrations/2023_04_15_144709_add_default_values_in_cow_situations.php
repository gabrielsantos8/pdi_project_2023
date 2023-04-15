<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AddDefaultValuesInCowSituations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cow_situations', function (Blueprint $table) {
            if (!DB::table('cow_situations')->where('descricao', 'Ativo')
                ->orWhere('descricao', 'Inativo - Desmama')
                ->orWhere('descricao', 'Inativo - Doente')
                ->exists()) {
                DB::table('cow_situations')->insert([
                    'descricao' => 'Ativo'
                ]);
                DB::table('cow_situations')->insert([
                    'descricao' => 'Inativo - Desmama'
                ]);
                DB::table('cow_situations')->insert([
                    'descricao' => 'Inativo - Doente'
                ]);
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cow_situations', function (Blueprint $table) {
            DB::table('cow_situations')->where('descricao', 'Ativo')
                ->orWhere('descricao', 'Inativo - Desmama')
                ->orWhere('descricao', 'Inativo - Doente')
                ->delete();
        });
    }
}
