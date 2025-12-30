<?php

use App\Models\Shipment;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table(Shipment::TABLE, function (Blueprint $table) {
            $table->foreignId('client_id')->after('user_id')->nullable()->constrained(User::TABLE)->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table(Shipment::TABLE, fn(Blueprint $table) => $table->dropForeign(['client_id']));
    }
};
