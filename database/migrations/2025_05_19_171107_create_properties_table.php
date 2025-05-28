<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('property_name');
            $table->string('type');
            $table->string('location');
            $table->decimal('pricing', 10, 2);
            $table->json('interest'); // e.g., {"view":"sea","floor":"3rd"}
            $table->text('rules_and_regulations')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable(); // main image
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('properties');
    }
}

