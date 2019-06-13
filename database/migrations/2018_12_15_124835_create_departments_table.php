<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Department;

class CreateDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dept_name');
            $table->string('lvl');
            $table->timestamps();
        });

        Department::create(['dept_name' => 'JHS', 'lvl' => '1']);
        Department::create(['dept_name' => 'ABM', 'lvl' => '2']);
        Department::create(['dept_name' => 'GAS', 'lvl' => '2']);
        Department::create(['dept_name' => 'HUMMS', 'lvl' => '2']);
        Department::create(['dept_name' => 'STEM', 'lvl' => '2']);
        Department::create(['dept_name' => 'BSA', 'lvl' => '3']);
        Department::create(['dept_name' => 'BSBA', 'lvl' => '3']);
        Department::create(['dept_name' => 'BSCS', 'lvl' => '3']);
        Department::create(['dept_name' => 'BEED', 'lvl' => '3']);
        Department::create(['dept_name' => 'CRIM', 'lvl' => '3']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('departments');
    }
}
