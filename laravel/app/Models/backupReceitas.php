<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Schema\Blueprint;

class Receitas extends Model
{
    use HasFactory;

    public function up()
    {
        Schema::create('receitas', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 255);
            $table->text('ingredientes');
            $table->text('modo_preparo');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('receitas');
    }


}
