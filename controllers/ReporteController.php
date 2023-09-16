<?php

namespace Controllers;

use Mpdf\Mpdf;
use MVC\Router;

class ReporteController{
    public static function pdf (Router $router){
        $mpdf = new Mpdf();
        $mpdf->Output();
    }
}