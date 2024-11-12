<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Ingresos;
use App\Models\Egresos;
use App\Models\Nominas;
use App\Http\Controllers\console;
use App\Models\Nomina;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\Catch_;

class DescargaController extends Controller
{
    public $apiKey = "27e3efc6-19b4-4c38-9ff5-3ed8942cadf6";

    public function showForm()
    {
        return view('pag1');
    }

    public function DescargaCFDI(Request $request)
    {
        // Obtener los datos del formulario
        $rfc = $request->input('rfc');
        $fechaInicial = Carbon::createFromFormat('Y-m-d', $request->input('Finicial'))->format('Y-m-d');
        $fechaFinal = Carbon::createFromFormat('Y-m-d', $request->input('Ffinal'))->format('Y-m-d');
        $request->validate([
            'rfc' => ['required', 'max:13'],
            'Finicial' => [],
            'Ffinal' => ['required', 'date', 'before_or_equal:today'],

        ]);

        // Crear la solicitud HTTP con Guzzle
        $client = new \GuzzleHttp\Client();
        try {
            $response = $client->request('POST', 'https://sistema.bovedafacturalo.com/ws/descargaCFDI', [
                'multipart' => [
                    ['name' => 'apiKey', 'contents' => $this->apiKey],
                    ['name' => 'rfc', 'contents' => $rfc],
                    ['name' => 'fInicial', 'contents' => $fechaInicial],
                    ['name' => 'fFinal', 'contents' => $fechaFinal],
                ]
            ]);
        
            // Procesar la respuesta de la API
            $body = $response->getBody()->getContents();
            $data = json_decode($body, true);
        
           
        
            // Validar los datos
            if (isset($data['codigo']) && isset($data['zip'])) {
                $codigo = $data['codigo'];
                $zip = $data['zip'];
                // Decodificar el archivo ZIP de base64
                $archivoBinario = base64_decode($zip);
                // Nombre del archivo 
                $nombreArchivo = $rfc . "_de_" . $fechaInicial . "_a_" . $fechaFinal . ".zip";
        
                // Guardamos el archivo en el sistema 
                Storage::put($nombreArchivo, $archivoBinario);
                $rutaArchivo = storage_path('app/' . $nombreArchivo);
        
                // Verificar si la carpeta XMLs existe y crearla si no
                if (!Storage::exists('xmls')) {
                    Storage::makeDirectory('xmls');
                } else {
                    // Limpiar la carpeta XMLs antes de la extracción
                    Storage::delete(Storage::files('xmls'));
                }
        
                // Extraer el archivo ZIP
                $zip = new \ZipArchive;
                if ($zip->open($rutaArchivo) === TRUE) {
                    $zip->extractTo(storage_path('app/xmls'));
                    $zip->close();
        
                    // Buscar archivos XML en subcarpetas
                    $archivosXMLEmitidos = Storage::allFiles('xmls/emitidos');
                    $archivosXMLRecibidos = Storage::allFiles('xmls/recibidos');
                    $archivosXML = array_merge($archivosXMLEmitidos, $archivosXMLRecibidos);
        
                    if (empty($archivosXML)) {
                        return response()->json([
                            'success' => false,
                            'message' => 'No se encontraron archivos XML después de la extracción. Ruta de extracción: ' . storage_path('app/xmls'),
                        ]);
                    }
        
                    // Procesar archivos XML y almacenar los datos
                    $facturasData = $this->procesarxmls($archivosXML);
                    if (empty($facturasData)) {
                        return response()->json([
                            'success' => false,
                            'message' => 'No se pudieron procesar los archivos XML. Archivos encontrados: ' . implode(', ', $archivosXML),
                        ]);
                    }
        
                    $this->almacenarFacturas($facturasData);
        
                    return response()->json([
                        'success' => true,
                        'fileName' => $nombreArchivo,
                        'fileContent' => base64_encode($archivoBinario),
                        'message' => 'Descarga y procesamiento exitoso'
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Error al descomprimir el archivo ZIP: ' . $rutaArchivo,
                    ]);
                }
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al descargar el archivo. Revisa los datos enviados.',
                ]);
            }
        } catch (\Exception $e) {
            // Agregar registro para verificar el error
            
        
            return response()->json([
                'success' => false,
                'message' => 'Error al descargar. La API no devolvió los datos esperados: ' . $e->getMessage()
            ]);
        }
        

        
    }



    public function procesarxmls(array $archivosXML)
    {
        $facturasData = [];
    
        foreach ($archivosXML as $archivoXML) {
            $contenidoXML = Storage::get($archivoXML);
            $xml = new \SimpleXMLElement($contenidoXML);
    
            try {
                $data = [
                    'RFC_Emisor' => (string) ($xml->Emisor['Rfc'] ?? 'N/A'),
                    'Nombre_Emisor' => (string) ($xml->Emisor['Nombre'] ?? 'N/A'),
                    'RegimenFiscal_Emisor' => (string) ($xml->Emisor['RegimenFiscal'] ?? 'N/A'),
                    'RFC_Receptor' => (string) ($xml->Receptor['Rfc'] ?? 'N/A'),
                    'Nombre_Receptor' => (string) ($xml->Receptor['Nombre'] ?? 'N/A'),
                    'UsoCFDI' => (string) ($xml->Receptor['UsoCFDI'] ?? 'N/A'),
                    'RegimenFiscalReceptor' => (string) ($xml->Receptor['RegimenFiscalReceptor'] ?? 'N/A'),
                    'DomicilioFiscalReceptor' => (string) ($xml->Receptor['DomicilioFiscalReceptor'] ?? 'N/A'),
                    'Version' => (string) ($xml['Version'] ?? 'N/A'),
                    'Serie' => (string) ($xml['Serie'] ?? 'N/A'),
                    'Folio' => (string) ($xml['Folio'] ?? 'N/A'),
                    'Fecha' => (string) ($xml['Fecha'] ?? 'N/A'),
                    'Sello' => (string) ($xml['Sello'] ?? 'N/A'),
                    'NoCertificado' => (string) ($xml['NoCertificado'] ?? 'N/A'),
                    'Certificado' => (string) ($xml['Certificado'] ?? 'N/A'),
                    'TipoDeComprobante' => (string) ($xml['TipoDeComprobante'] ?? 'N/A'),
                    'FormaPago' => (string) ($xml['FormaPago'] ?? 'N/A'),
                    'MetodoPago' => (string) ($xml['MetodoPago'] ?? 'N/A'),
                    'LugarExpedicion' => (string) ($xml['LugarExpedicion'] ?? 'N/A'),
                    'SubTotal' => (float) ($xml['SubTotal'] ?? 0.0),
                    'Descuento' => (float) ($xml['Descuento'] ?? 0.0),
                    'Total' => (float) ($xml['Total'] ?? 0.0),
                    'TotalImpuestosTrasladados' => (float) ($xml->Impuestos['TotalImpuestosTrasladados'] ?? 0.0),
                    'TotalImpuestosRetenidos' => (float) ($xml->Impuestos['TotalImpuestosRetenidos'] ?? 0.0),
                    'CadenaOriginal' => (string) ($xml['Sello'] ?? 'N/A')
                ];
    
                $facturasData[] = $data;
    
            } catch (\Exception $e) {

                return response()->json([
                    'success' => false,
                'message' =>('Error procesando XML: ' . $e->getMessage())
                ]);
                
            }
        }
    
        return $facturasData;
    }
    

    public function almacenarFacturas(array $facturasData)
    {
        foreach ($facturasData as $data) {
            // Determina el tipo de comprobante
            $tipoComprobante = $data['TipoDeComprobante'];

            // Almacena en la tabla correspondiente según el tipo de comprobante
            switch ($tipoComprobante) {
                case 'I': // Factura
                    Ingresos::create($data);
                    break;
                case 'E': // Nota de crédito
                    Egresos::create($data);
                    break;
                case 'N': // Nota de débito
                    Nominas::create($data);
                    break;
                default:
                    // Manejar casos no contemplados o registrar error
                    break;
            }
        }
    }
}
