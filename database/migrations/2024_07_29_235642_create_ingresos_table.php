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
        Schema::create('ingresos', function (Blueprint $table) {
            $table->id();
            $table->string('RFC_Emisor', 13);
            $table->string('Nombre_Emisor');
            $table->string('RegimenFiscal_Emisor');
            $table->string('RFC_Receptor', 13);
            $table->string('Nombre_Receptor');
            $table->string('UsoCFDI');
            $table->string('RegimenFiscalReceptor');
            $table->string('DomicilioFiscalReceptor');
            $table->string('Version');
            $table->string('Serie')->nullable();
            $table->string('Folio')->nullable();
            $table->dateTime('Fecha');
            $table->text('Sello');
            $table->string('NoCertificado');
            $table->text('Certificado');
            $table->string('TipoDeComprobante');
            $table->string('FormaPago');
            $table->string('MetodoPago');
            $table->string('LugarExpedicion');
            $table->decimal('SubTotal', 15, 2);
            $table->decimal('Descuento', 15, 2)->nullable();
            $table->decimal('Total', 15, 2);
            $table->decimal('TotalImpuestosTrasladados', 15, 2)->nullable();
            $table->decimal('TotalImpuestosRetenidos', 15, 2)->nullable();
            $table->text('CadenaOriginal')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingresos');
    }
};
