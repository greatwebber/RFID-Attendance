<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDepartmentIdToLecturersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lecturers', function (Blueprint $table) {
            // Remove old 'department' column (assuming it's a string)
            $table->dropColumn('department');

            // Add 'department_id' as a foreign key
            $table->foreignId('department_id')->constrained()->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('lecturers', function (Blueprint $table) {
            // Rollback: Remove 'department_id' and restore 'department' column
            $table->dropForeign(['department_id']);
            $table->dropColumn('department');
            $table->string('department'); // Restore old column
        });
    }
}
