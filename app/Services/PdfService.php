<?php

namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf;

class PdfService
{
    public function generarVenta($venta)
    {
        $venta->load('detalles.producto',
                    'empresa',
                    'empresa.pais',
                    'empresa.departamento',
                    'empresa.ciudad',
                    'empresa.moneda',
                    'sucursal',
                    'cliente'
                    );
                    
        $pdf = Pdf::loadView('admin.ventas.pdf', [
            'venta' => $venta,
            'empresa' => $venta->empresa,
            'cliente' => $venta->cliente,
            'sucursal' => $venta->sucursal,
            'cliente' => $venta->cliente,
        ]);
        //return view('admin.ventas.pdf');

        return $pdf->stream('venta-'.$venta->id.'.pdf');
        // o download()
    }
}