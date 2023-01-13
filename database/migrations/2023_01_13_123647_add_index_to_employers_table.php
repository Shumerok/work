<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employers', function (Blueprint $table) {
            $table->index('admin_created_id', 'employer_user_idx');
            $table->foreign('admin_created_id', 'employer_user_fk')->on('users')->references('id')->onDelete(
                'set null'
            );

            $table->index('admin_updated_id', 'employer_user_idv');
            $table->foreign('admin_updated_id', 'employer_user_fkv')->on('users')->references('id')->onDelete(
                'set null'
            );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employers', function (Blueprint $table) {
            $table->dropForeign('employer_user_fk');
            $table->dropColumn('admin_created_id');
            $table->dropForeign('employer_user_fkv');
            $table->dropColumn('admin_updated_id');
        });
    }
};
