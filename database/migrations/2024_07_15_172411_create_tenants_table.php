<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('marketer_id')->constrained('users');
            $table->string('name');
            $table->enum('district', [
                'Alappuzha', 'Ernakulam', 'Idukki', 'Kannur', 'Kasaragod',
                'Kollam', 'Kottayam', 'Kozhikode', 'Malappuram', 'Palakkad',
                'Pathanamthitta', 'Thiruvananthapuram', 'Thrissur', 'Wayanad'
            ]);
            $table->string('place');
            $table->string('address');
            $table->string('pincode', 6);
            $table->string('phone');
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->enum('visibility', ['Public', 'Private'])->default('public');
            $table->enum('subscription_status', ['Active', 'Inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};
