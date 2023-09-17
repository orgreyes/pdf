<?php

namespace Controllers;

use Mpdf\Mpdf;
use MVC\Router;

class ReporteController{
    public static function pdf (Router $router){
        $mpdf = new Mpdf([
            "orientation" => "P",
            "default_font_size" => 12,
            "default_font" => "arial",
            "format" => "Letter",
            "mode" => 'utf-8'
        ]);
        $mpdf->SetMargins(30,35,45);
        $html = $router->load('reporte/pdf');
        $htmlHeader = $router->load('reporte/header');
        $htmlFooter = $router->load('reporte/footer');
        $mpdf->SetHTMLHeader($htmlHeader);
        $mpdf->SetHTMLFooter($htmlFooter);

        $mpdf->WriteHTMl($html);
        $mpdf->Output();
    }
}