<?php

use App\Models\Shipment;
use App\Models\ShipmentDocument;
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
        Schema::create(ShipmentDocument::TABLE, function (Blueprint $table) {
            $table->id();
            $table->foreignId('shipment_id')->constrained(Shipment::TABLE)->onDelete('cascade');
            $table->string('document_name', 128);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(ShipmentDocument::TABLE);
    }
};
