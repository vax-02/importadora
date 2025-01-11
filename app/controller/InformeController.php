<?php
//require_once '/../app/library/jpgraph/src/jpgraph.php';
//require_once '/'.APP_NAME.'/app/library/jpgraph/src/jpgraph_line.php';

class Informe extends Controller{

    public function index(){
        $telas = $this->model('Tela')->getTop();
        //print_r($telas);
        $sucursales = $this->model('Sucursal')->getSucursales();
        $this->view('informe/informe',$telas);
    }
    public function getSucursales(){
        $suc = $this->model('Sucursal')->getSucursales();
        echo json_encode($suc);
    }

    public function getPersonalTopFive(){
        $per = $this->model('Personal')->getPersonalTop();
        echo json_encode($per);
    }
    public function ventasSucursal(){
        date_default_timezone_set('America/La_Paz');
        $fechaActual = date('Y-m-d'); // Formato YYYY-MM-DD
        $this->view('informe/sucursal',$fechaActual);
    }

    public function ventasPersonal(){
        date_default_timezone_set('America/La_Paz');
        $fechaActual = date('Y-m-d'); // Formato YYYY-MM-DD
        $this->view('informe/personal',$fechaActual);
    }
    public function ventaTelas(){
        $this->view('informe/telas');

    }
    public function getSellTelas(){
        $telas = $this->model('Tela')->getSellTelas();
        echo json_encode($telas);
    }
    public function getSellMarcas(){
        $marca = $this->model('Marca')->getSellMarcas();
        echo json_encode($marca);
    }

    public function getSucursalesForDate(){
        $sucursales = $this->model('Sucursal')->getSucursalesForDate( $_GET['date']);
        echo json_encode($sucursales);
    }

    public function informeForMonth(){
        $sucursales = $this->model('Sucursal')->getSucursalForMonth($_GET['year'],$_GET['month']);
        echo json_encode($sucursales);
    }

    public function informeForWeek(){
        $sucursales = $this->model('Sucursal')->getSucursalForWeek($_GET['inicio'],$_GET['fin']);
        echo json_encode($sucursales);
    }
    
    public function sellsToExcel(){
        $personal = $this->model('Personal')->getPersonalAllTop();

        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename='.'informeEmpleados.xls');
        header('Pragma: no-cache');
        header('Expires: 0');
        echo '<table border=1><tr>';
        echo '<th style="background: aquamarine;" colspan=5>REPORTE DE LOS MEJORES VENDEDORES</th></tr>';
        echo '<tr>';
            echo '<td style="background: aquamarine;">NOMBRE COMPLETO</td>';
            echo '<td style="background: aquamarine;">USUARIO</td>';
            echo '<td style="background: aquamarine;">ESTADO</td>';
            echo '<td style="background: aquamarine;">CELULAR</td>';
            echo '<td style="background: aquamarine;">VENTAS REALIZADAS</td>';
            echo '</tr>';
        foreach($personal as $p){
            echo '<tr>';
            if($p['ESTADO'] == 'INACTIVO'){
                echo '<td style="background:yellow;">'.$p['PERSONAL'].'</td>';
                echo '<td style="background:yellow;">'.$p['USUARIO'].'</td>';
                echo '<td style="background:yellow;">'.$p['ESTADO'].'</td>';
                echo '<td style="background:yellow;">'.$p['CELULAR'].'</td>';
                echo '<td style="background:yellow;">'.$p['VENTASR'].'</td>';

            }else{
                echo '<td>'.$p['PERSONAL'].'</td>';
                echo '<td>'.$p['USUARIO'].'</td>';
                echo '<td>'.$p['ESTADO'].'</td>';
                echo '<td>'.$p['CELULAR'].'</td>';
                echo '<td>'.$p['VENTASR'].'</td>';
            }
            echo '</tr>';
        }
        echo '</table>';
    }
    public function sellsToPdf(){
        $personal = $this->model('Personal')->getPersonalAllTop();

        $pdf = new FPDF();
        $pdf->AddPage('P', array(215.9, 279.4));

        $pdf->SetFont('Arial', '', 12);
        $pdf->SetY(10);
        $pdf->Cell(0, 4, COMPANY_NAME, 0, 1, 'L');
        $pdf->Cell(0, 4, ADDRESS_COMPANY, 0, 1, 'L');
        $pdf->Cell(0, 4, PHONE_COMPANY, 0, 1, 'L');
        $pdf->Cell(0, 4, EMAIL_COMPANY, 0, 1, 'L');

        $pdf->Image('../public/img/importadora.png', $pdf->SetX(46 * 4), 10, 15);
        $pdf->Ln(2);
        $pdf->SetFont('Arial', 'B', 18);
        $pdf->Cell(0, 10, 'REPORTE DE LOS MEJORES VENDEDORES', 0, 1, 'C');

        $pdf->SetFillColor(200, 220, 255); // Color de fondo para los encabezados
        $pdf->SetFont('Arial', 'B', 11);

        $pdf->Cell(65, 10, 'NOMBRE COMPLETO', 1, 0, 'C', true);
        $pdf->Cell(35, 10, 'USUARIO', 1, 0, 'C', true);
        $pdf->Cell(22, 10, 'ESTADO', 1, 0, 'C', true);
        $pdf->Cell(25, 10, 'CELULAR', 1, 0, 'C', true);
        $pdf->Cell(45, 10, 'VENTAS REALIZADAS', 1, 0, 'C', true);
        $pdf->Ln();
        foreach($personal as $p){
            $pdf->Cell(65, 10, $p['PERSONAL'], 1, 0, 'C');
            $pdf->Cell(35, 10, $p['USUARIO'], 1, 0, 'C');
            $pdf->Cell(22, 10, $p['ESTADO'], 1, 0, 'C');
            $pdf->Cell(25, 10, $p['CELULAR'], 1, 0, 'C');
            $pdf->Cell(45, 10, $p['VENTASR'], 1, 1, 'C');
            
        }

        $pdf->Output('I', 'ventas.pdf');
    }

    public function telasToExcel(){
        $telas = $this->model('Tela')->getInfoSellTelas();

        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename='.'informeMarcas.xls');
        header('Pragma: no-cache');
        header('Expires: 0');
        echo '<table border=1><tr>';
        echo '<th style="background: aquamarine;" colspan=6>Informe sobre las telas</th></tr>';
        echo '<tr>';
            echo '<td style="background: aquamarine;">NOMBRE</td>';
            echo '<td style="background: aquamarine;">CALIDAD</td>';
            echo '<td style="background: aquamarine;">MARCA</td>';
            echo '<td style="background: aquamarine;">PRECIO POR METRO (VENTA)</td>';
            echo '<td style="background: aquamarine;">PRECIO POR METRO (ADQUISICION)</td>';
            echo '<td style="background: aquamarine;">ROLLOS EXISTENTES</td>';
        echo '</tr>';
        foreach($telas as $p){
            echo '<tr>';
            if($p['TOTAL_ROLLOS'] == 0){
                $back = 'style="background:red; color:white;"';
            }else if($p['TOTAL_ROLLOS'] < 3){
                $back = 'style="background:yellow;"';                
            }else{
                $back='';
            }
            echo '<td '.$back.'>'.$p['NOMBRE'].'</td>';
            echo '<td '.$back.'>'.$p['CALIDAD'].'</td>';
            echo '<td '.$back.'>'.$p['MARCA'].'</td>';
            echo '<td '.$back.'>'.$p['PRECIO_METRO'].'</td>';
            echo '<td '.$back.'>'.$p['PRECIO_METRO_REAL'].'</td>';
            echo '<td '.$back.'>'.$p['TOTAL_ROLLOS'].'</td>';
            echo '</tr>';
        }
        echo '</table>';
    }
    public function marcasToExcel(){
        $marcas = $this->model('Marca')->getSellMarcas();

        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename='.'InformeMarcas.xls');
        header('Pragma: no-cache');
        header('Expires: 0');
        echo '<table border=1><tr>';
        echo '<th style="background: aquamarine;" colspan=2>Informe sobre las marcas</th></tr>';
        echo '<tr>';
            echo '<td style="background: aquamarine;">MARCA</td>';
            echo '<td style="background: aquamarine;">METROS VENDIDOS</td>';
        echo '</tr>';
        foreach($marcas as $p){
            echo '<tr>';
            echo '<td >'.$p['DESCRIPCION'].'</td>';
            echo '<td >'.$p['METROS'].'</td>';
            echo '</tr>';
        }
        echo '</table>';
    }
    public function telasToPdf(){
        $telas = $this->model('Tela')->getInfoSellTelas();
        
        $pdf = new FPDF();
        $pdf->AddPage('P', array(215.9, 279.4));
    
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetY(10);
        $pdf->Cell(0, 4, COMPANY_NAME, 0, 1, 'L');
        $pdf->Cell(0, 4, ADDRESS_COMPANY, 0, 1, 'L');
        $pdf->Cell(0, 4, PHONE_COMPANY, 0, 1, 'L');
        $pdf->Cell(0, 4, EMAIL_COMPANY, 0, 1, 'L');
    
        $pdf->Image('../public/img/importadora.png', $pdf->SetX(46 * 4), 10, 15);
        $pdf->Ln(2);
        $pdf->SetFont('Arial', 'B', 18);
        $pdf->Cell(0, 10, 'REPORTE DE LAS TELAS', 0, 1, 'C');
    
        $pdf->SetFillColor(200, 220, 255); // Color de fondo para los encabezados
        $pdf->SetFont('Arial', 'B', 11);
    
        $pdf->Cell(60, 10, 'NOMBRE', 1, 0, 'C', true);
        $pdf->Cell(40, 10, 'MARCA', 1, 0, 'C', true);
        $pdf->Cell(20, 10, 'CALIDAD', 1, 0, 'C', true);

        $pdf->Cell(28, 10, 'PRECIO REAL', 1, 0, 'C', true);
        $pdf->Cell(22, 10, 'PRECIO', 1, 0, 'C', true);
        $pdf->Cell(20, 10, 'ROLLOS', 1, 0, 'C', true);
        $pdf->Ln();
        $pdf->SetFont('Arial', '', 11);
        
        foreach($telas as $p){
            $pdf->Cell(60, 10, $p['NOMBRE'], 1, 0, 'C');
            $pdf->Cell(40, 10, $p['MARCA'], 1, 0, 'C');
            $pdf->Cell(20, 10, $p['CALIDAD'], 1, 0, 'C');
            $pdf->Cell(28, 10, $p['PRECIO_METRO_REAL'], 1, 0, 'C');
            $pdf->Cell(22, 10, $p['PRECIO_METRO'], 1, 0, 'C');
            $pdf->Cell(20, 10, $p['TOTAL_ROLLOS'], 1, 1, 'C');
        }
        $pdf->Output('I', 'TELAS.pdf');
    }
    public function sucursalesToExcel(){
        $isSells = true;
        $back='';
        $inforSucursales = $this->model('Sucursal')->getInfoSucursal();

        
        foreach($inforSucursales as &$info){
            $info['ventas'] = $this->model('Sucursal')->getVentaEmpleados($info['CODSUCURSAL'],$_GET['date']);
        }
        
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename='.'InformeVentasPorSucursal.xls');
        header('Pragma: no-cache');
        header('Expires: 0');
        echo '<table border=1><tr>';
        echo '<th colspan="9" style="font-size: 20px; text-align: center; background-color: #f2f2f2; height: 40px;">Informe sobre las ventas (fecha seleccionada)</th>';
        
        
        foreach($inforSucursales as $p){
            echo '<tr>'
            .'<td colspan="3" style="background: aquamarine;">Sucursal</td>'
            .'<td colspan="1" style="background: aquamarine;">Telefono</td>'
            .'<td colspan="3" style="background: aquamarine;">Encargado</td>'
            .'<td colspan="2" style="background: aquamarine;">Fecha</td>'
            .'</tr>';

            echo '<tr>'
            .'<td colspan="3">'.$p['NOMBRE'].'</td>'
            .'<td colspan="1">'.$p['TELEFONO'].'</td>'
            .'<td colspan="3">'.$p['ENCARGADO'].'</td>'
            .'<td colspan="2">'.$_GET['date'].'</td>'
            .'</tr>';

            echo '<tr></tr>';
            
            echo '<tr>'
            .'<td colspan="2" style="background: aquamarine;">Vendedor</td>'
            .'<td style="background: aquamarine;">Tela</td>'
            .'<td style="background: aquamarine;">Marca</td>'
            .'<td style="background: aquamarine;">Cantidad (m)</td>'
            .'<td style="background: aquamarine;">Precio real</td>'
            .'<td style="background: aquamarine;">Precio de venta</td>'
            .'<td style="background: aquamarine;">Venta Total</td>'
            .'<td style="background: aquamarine;">Ganancia</td>'
            .'</tr>';
            
            $totalGanacia = 0;
            $totalVentas = 0;
            foreach($p['ventas'] as $sell){
                $back = ($sell['PRECIOV']-$sell['PRECIOR'] <= 0)? 'style="background:red; color:white;"' : '';
                
                echo '<tr>'
                .'<td colspan="2" '.$back.'>'.$sell['NOMBRE'].'</td>'
                .'<td '.$back.'>'.$sell['TELA'].'</td>'
                .'<td '.$back.'>'.$sell['MARCA'].'</td>'
                .'<td '.$back.'>'.$sell['CANTIDAD'].'</td>'
                .'<td '.$back.'>'.$sell['PRECIOR'].'</td>'
                .'<td '.$back.'>'.$sell['PRECIOV'].'</td>'
                .'<td '.$back.'> '.$sell['PRECIOV'] * $sell['CANTIDAD'].' </td>'
                .'<td '.$back.'>'.($sell['PRECIOV']-$sell['PRECIOR'])*$sell['CANTIDAD'].'</td>'
                .'</tr>';
                
                $totalGanacia += ($sell['PRECIOV'] - $sell['PRECIOR'])*$sell['CANTIDAD'];  

                $totalVentas += $sell['PRECIOV'] * $sell['CANTIDAD'];
                $isSells = false;
            }
            
            echo '<tr>';
            echo '<td colspan="6"></td>';
            echo '<td '.$back.'>Total</td>';
            echo '<td '.$back.'>'.$totalVentas.'</td>';
            echo '<td '.$back.'>'.$totalGanacia.'</td>';
            echo '</tr>';
            echo '<tr></tr>';
            
            
            
                if($isSells){
                    echo '<tr>';
                    echo '<td colspan="8" style="background:#F28D8D; text-align:center;">NO TIENE VENTA EL DIA DE HOY</td>';
                    echo '</tr>';       
                    echo '<tr>';
                    echo '</tr>';

                }
                $isSells = true;
        }
        echo '</table>';

        
        //PARA TODAS LAS VENTAS
        $isSells = true;
        $inforSucursales = $this->model('Sucursal')->getInfoSucursal();
        foreach($inforSucursales as &$info){
            $info['ventas'] = $this->model('Sucursal')->getVentaAllEmpleados($info['CODSUCURSAL']);
        }


        echo '<table border=1><tr>';
        echo '<th colspan="8" style="font-size: 20px; text-align: center; background-color: #f2f2f2; height: 40px;">Informe de TODAS las ventas por sucursal</th>';


        foreach($inforSucursales as $p){
            echo '<tr>';
                echo '<td colspan="3" style="background: aquamarine;">Sucursal</td>';
                echo '<td colspan="2" style="background: aquamarine;">Telefono</td>';
                echo '<td colspan="3" style="background: aquamarine;">Encargado</td>';
       

            echo '</tr>';
            echo '<tr>';
                echo '<td colspan="3">'.$p['NOMBRE'].'</td>';
                echo '<td colspan="2">'.$p['TELEFONO'].'</td>';
                echo '<td colspan="3">'.$p['ENCARGADO'].'</td>';
            echo '</tr>';
            
            echo '<tr>';
            echo '</tr>';
            
            echo '<tr>';
                echo '<td colspan="2" style="background: aquamarine;">Vendedor</td>';
                echo '<td style="background: aquamarine;">Tela</td>';
                echo '<td style="background: aquamarine;">Cantidad (m)</td>';
                echo '<td style="background: aquamarine;">Precio real</td>';
                echo '<td style="background: aquamarine;">Precio de venta</td>';
                echo '<td style="background: aquamarine;">Fecha</td>';
                echo '<td style="background: aquamarine;">Ganancia</td>';



            echo '</tr>';
            $totalGanacia = 0;
            foreach($p['ventas'] as $sell){
                echo '<tr>';

                if($sell['PRECIOV']-$sell['PRECIOR'] <= 0){
                        $back = 'style="background:red; color:white;"';
                }else{ $back=''; }

                    echo '<td colspan="2" '.$back.'>'.$sell['NOMBRE'].'</td>';
                    echo '<td '.$back.'>'.$sell['TELA'].'</td>';
                    echo '<td '.$back.'>'.$sell['CANTIDAD'].'</td>';
                    echo '<td '.$back.'>'.$sell['PRECIOR'].'</td>';
                    echo '<td '.$back.'>'.$sell['PRECIOV'].'</td>';
                    echo '<td '.$back.'>'.$sell['FV'].'</td>';
                    echo '<td '.$back.'>'.($sell['PRECIOV']-$sell['PRECIOR'])*$sell['CANTIDAD'].'</td>';
                    echo '</tr>';

             

                    $totalGanacia += ($sell['PRECIOV'] - $sell['PRECIOR'])*$sell['CANTIDAD'];
                    

                    $isSells = false;
            }
            
            echo '<tr>';
            echo '<td colspan="6"></td>';
            echo '<td '.$back.'>Total</td>';
            echo '<td '.$back.'>'.$totalGanacia.'</td>';
            echo '</tr>';
            echo '<tr></tr>';
            
            
            
                if($isSells){
                    echo '<tr>';
                    echo '<td colspan="8" style="background:#F28D8D; text-align:center;">NO TIENE VENTA EL DIA DE HOY</td>';
                    echo '</tr>';       
                    echo '<tr>';
                    echo '</tr>';

                }
                $isSells = true;
            }
            echo '</table>';

        echo '</table>';


    }
}
