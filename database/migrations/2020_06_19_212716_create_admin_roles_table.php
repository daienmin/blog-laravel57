<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_roles', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->engine = 'Innodb';
            $table->collation = 'utf8_general_ci';
            $table->increments('id');
            $table->unsignedInteger('pid')->nullable(false)->default(0)
                ->comment('父角色id');
            $table->string('role_name', 30)->nullable(false)->default('')
                ->comment('角色名称');
            $table->string('description', 200)->nullable(false)->default('')
                ->comment('描述');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_roles');
    }
}
