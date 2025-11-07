<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riders', function (Blueprint $table) {
            $table->id();
            $table->string('registration_number')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('national_id')->unique();
            $table->date('date_of_birth');
            $table->string('phone_number');
            $table->string('email')->nullable();
            $table->text('address');
            $table->string('photo')->nullable();
            
            // License details
            $table->string('license_number');
            $table->date('license_issue_date');
            $table->date('license_expiry_date');
            $table->string('license_class');
            
            // Emergency contact
            $table->string('emergency_contact_name');
            $table->string('emergency_contact_phone');
            $table->string('emergency_contact_relationship');
            
            // Stage assignment
            $table->foreignId('stage_id')->constrained()->onDelete('cascade');
            
            // Status
            $table->enum('status', ['pending', 'active', 'inactive', 'suspended'])->default('pending');
            
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
        Schema::dropIfExists('riders');
    }
}
