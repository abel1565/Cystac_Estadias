<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingresos extends Model
{
    use HasFactory;
    protected $fillable = [
        'RFC_Emisor', 
        'Nombre_Emisor', 
        'RegimenFiscal_Emisor', 
        'RFC_Receptor', 
        'Nombre_Receptor', 
        'UsoCFDI', 
        'RegimenFiscalReceptor', 
        'DomicilioFiscalReceptor', 
        'Version', 
        'Serie', 
        'Folio',
        'Fecha', 
        'Sello', 
        'NoCertificado', 
        'Certificado', 
        'TipoDeComprobante', 
        'FormaPago', 
        'MetodoPago', 
        'LugarExpedicion', 
        'SubTotal', 
        'Descuento', 
        'Total', 
        'TotalImpuestosTrasladados', 
        'TotalImpuestosRetenidos', 
        'CadenaOriginal' 
    ];

}
