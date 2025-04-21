<?php
//require_once '/../app/library/jpgraph/src/jpgraph.php';
//require_once '/'.APP_NAME.'/app/library/jpgraph/src/jpgraph_line.php';

class Informe extends Controller{

    public function index(){
        $telas = $this->model('Tela')->getTop();
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
    public function compras(){
        date_default_timezone_set('America/La_Paz');
        $fechaActual = date('Y-m-d'); // Formato YYYY-MM-DD
        $this->view('informe/clientes',$fechaActual);
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
    public function getComprasClientes(){
        $suc = $this->model('Cliente')->getComprasCliente();
        echo json_encode($suc);
    }
    public function getSucursalesForDate(){
        $sucursales = $this->model('Sucursal')->getSucursalesForDate($_GET['date']);
        echo json_encode($sucursales);
    }

    public function getClientesForDate(){
        $sucursales = $this->model('Cliente')->getClientesForDate($_GET['date']);
        
        echo json_encode($sucursales);
    }


    public function informeForMonth(){
        $sucursales = $this->model('Sucursal')->getSucursalForMonth($_GET['year'],$_GET['month']);
        echo json_encode($sucursales);
    }

    public function informeClientesForMonth(){
        $sucursales = $this->model('Cliente')->getClienteForMonth($_GET['year'],$_GET['month']);
        echo json_encode($sucursales);
    }
    public function informeForWeek(){
        $sucursales = $this->model('Sucursal')->getSucursalForWeek($_GET['inicio'],$_GET['fin']);
        echo json_encode($sucursales);
    }
    
    
    public function informeClientesForWeek(){
        $sucursales = $this->model('Cliente')->getClienteForWeek($_GET['inicio'],$_GET['fin']);
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

        $back_titles = 'background-color: #f2f2f2;';
        $inforSucursales = $this->model('Sucursal')->getInfoSucursal();

        switch($_GET['type']){
            case 1: //DAY    
                foreach($inforSucursales as &$info){
                    $info['ventas'] = $this->model('Sucursal')->getVentasEmpleados($info['CODSUCURSAL'],$_GET['date']);
                    if(count($info['ventas']) > 0){
                        foreach($info['ventas'] as &$detalle){
                            $detalle['detalle'] = $this->model('Sucursal')->detalleDeVentaDeEmpleados($detalle['CODVENTA']);
                        }
                    }
                }
                break;
            case 2: //WEEK
                foreach($inforSucursales as &$info){
                    $info['ventas'] = $this->model('Sucursal')->getVentasEmpleadosForWeek($info['CODSUCURSAL'],$_GET['inicio'],$_GET['fin']);
                    if(count($info['ventas']) > 0){
                        foreach($info['ventas'] as &$detalle){
                            $detalle['detalle'] = $this->model('Sucursal')->detalleDeVentaDeEmpleados($detalle['CODVENTA']);
                        }
                    }
                }
                break;
            case 3: //MONTH
                foreach($inforSucursales as &$info){
                    $info['ventas'] = $this->model('Sucursal')->getVentasEmpleadosForMonth($info['CODSUCURSAL'],$_GET['year'],$_GET['month']);
                    if(count($info['ventas']) > 0){
                        foreach($info['ventas'] as &$detalle){
                            $detalle['detalle'] = $this->model('Sucursal')->detalleDeVentaDeEmpleados($detalle['CODVENTA']);
                        }
                    }
                }
        }
        define('ALLDATE',$inforSucursales);

        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="InformeVentasPorSucursal.xls"');
        header('Pragma: no-cache');
        header('Expires: 0');        
        echo '<table border=1><tr>';

        switch ($_GET['type']){
            case 1:
                $title = "INFORME POR DIA";
                break;
            case 2:
                $title = "INFORME POR SEMANA";
                break;
            case 3:
                $title = "INFORME POR MES";
        }
        
        echo '<th colspan="10" style="font-size: 20px; text-align: center; '.$back_titles.' height: 40px;">'.$title.'</th>';
        
        
        foreach(ALLDATE as $sucursal){
            echo '<tr style="text-align:center;"> '
            .'<td colspan="10" style="color: #ffffff; background-color:rgb(92, 143, 211);"><b>Sucursal</b></td>'
            .'</tr>'
            .'<tr style="text-align:center;">'
            .'<td rowspan="2" colspan="10" style="font-size: 20px;">'.$sucursal['NOMBRE'].'</td>'
            .'</tr> <tr></tr>'
            .'<tr style="text-align:center;">'
            .'<td colspan="4" style="'.$back_titles.'"><b>Encargado</b></td>'
            .'<td colspan="3" style="'.$back_titles.'"><b>Telefono</b></td>'
            .'<td colspan="3" style="'.$back_titles.'"><b>Fecha</b></td>'
            .'</tr>';

            echo '<tr style="text-align: center;">'
            .'<td colspan="4">'.$sucursal['ENCARGADO'].'</td>'
            .'<td colspan="3">'.$sucursal['TELEFONO'].'</td>';

            switch($_GET['type']){
                case 1:
                    $fecha = $_GET['date'];
                break;
                case 2:
                    $fecha = $_GET['inicio']. ' - '.$_GET['fin'];
                break;
                case 3:
                    $fecha = $_GET['year']. ' - '.$_GET['month'];
            }

            echo '<td colspan="3">'.$fecha.'</td>'
            .'</tr><tr></tr>';

            echo '<tr><td colspan="10" style="text-align:center; '.$back_titles.'"><b>VENTAS</b></td></tr><tr></tr>';
 

            if(count($sucursal['ventas']) > 0 ){    
                foreach($sucursal['ventas'] as $venta){
                    
                    if($venta['TIPO_VENTA'] == 1){
                        $tipo_venta = 'Rollo(s)'; 
                        $tipo_venta_bool = true ; 
                    }else{
                        $tipo_venta = 'Metro(s)' ; 
                        $tipo_venta_bool = false ; 
                    }

                    echo 
                    '<tr style="text-align:center;">'
                    .'<td colspan="4" style="'.$back_titles.'"><b>Vendedor</b></td>';

                    $titleTimeDate = ($_GET['type'] == 1)? 'Hora': 'Fecha / Hora';
                    $timeDate = ($_GET['type'] == 1)? $venta['HORA_VENTA'] : $venta['FECHA_VENTA'];
                    echo '<td style="'.$back_titles.'"><b>'.$titleTimeDate.'</b></td>'
                    .'<td style="'.$back_titles.'"><b>Unidad de venta</b></td>'
                    .'<td style="'.$back_titles.'"><b>Descuento (%)</b></td>'
                    .'</tr>'
                    .'<tr style="text-align:center;">'
                    .'<td colspan="4"> '.$venta['NOMBRE'].'</td>'
                    .'<td >'.$timeDate.'</td>'
                    .'<td >'.$tipo_venta.'</td>'
                    .'<td >'.$venta['DESCUENTO'].'</td>'
                    .'</tr>'.
                    '<tr><td colspan="10" style="text-align:center;'.$back_titles.'"><b>DETALLE DE LA VENTA</b></td></tr>';
                    $totalVenta = 0;
                    $totalGanancia = 0;
                    echo
                    '<tr style="text-align:center;">'
                        .'<td colspan="2" style="'.$back_titles.'"><b>Tela</b></td>'
                        .'<td  style="'.$back_titles.'"><b>Color</b></td>'
                        .'<td colspan="2" style="'.$back_titles.'"><b>Marca</b></td>'
                        .'<td style="'.$back_titles.'"><b>Cantidad</b></td>'
                        .'<td style="'.$back_titles.'"><b>Precio real</b></td>'
                        .'<td style="'.$back_titles.'"><b>Precio de venta</b></td>'
                        .'<td style="'.$back_titles.'"><b>Sub. Total</b></td>'
                        .'<td style="'.$back_titles.'"><b>Ganancia</b></td>'
                        .'</tr>';
                    foreach($venta['detalle'] as $detalle){
                        if($tipo_venta_bool){
                            $detalle['CANTIDAD'] /= $detalle['MROLLOCOMPLETO'];
                            $detalle['PRECIOR'] = $detalle['PRECIOROLLOREAL'];
                        }
                        $subtotal = $detalle['CANTIDAD']*$detalle['PRECIOV'];
                        $ganancia = $subtotal - $detalle['CANTIDAD']*$detalle['PRECIOR'] ;
                        $totalVenta += $subtotal;
                        $totalGanancia += $ganancia;
                        
                        echo 
                        '<tr style="text-align:center;">'
                        .'<td colspan="2" >'.$detalle['TELA'].'</td>'
                        .'<td  style="background:  '.$detalle['CODCOLOR'].'"></td>'
                        .'<td colspan="2">'.$detalle['MARCA'].'</td>'
                        .'<td>'.$detalle['CANTIDAD'].'</td>'
                        .'<td>'.$detalle['PRECIOR'].'</td>'
                        .'<td>'.$detalle['PRECIOV'].'</td>'
                        .'<td>'.$subtotal.'</td>'
                        .'<td>'.$ganancia.'</td>'
                        .'</tr>';
                    }
                    if($venta['DESCUENTO']!=0){
                        $totalGanancia = ($totalVenta - ($totalVenta*$venta['DESCUENTO']/100)) - $totalGanancia;
                    }

                        echo
                        '<tr></tr><tr><tr style="text-align:center;">'
                        .'<td style="'.$back_titles.'">Sub. Total final</td>'
                        .'<td > '.$totalVenta.'</td>'
                        .'<td >'.$totalGanancia.'</td>'
                        .'</tr>'
                        
                        .'<tr style="text-align:center;">'
                        .'<td style="'.$back_titles.'">Descuento</td>'
                        .'<td >'.$venta['DESCUENTO'].' %</td>'
                        .'<td > - - </td>'
                        .'</tr>'
                        
                        .'<tr style="text-align:center;">'
                        .'<td style="'.$back_titles.'">Total</td>'
                        .'<td >'.$totalVenta - ($totalVenta*$venta['DESCUENTO']/100).'</td>'
                        .'<td >'.$totalGanancia.'</td>'

                        .'</tr>'
                        ;
                    
                    echo '<tr></tr>';
                }
            }else{
            echo '<tr><td colspan="10" style="text-align:center; background:rgb(229, 255, 0);"><b>SIN VENTAS</b></td></tr><tr></tr>';
            }
            echo '<tr></tr><tr></tr>';           
        }
        echo '</table>';
    }
    public function clientesToExcel(){

        $back_titles = 'background-color: #f2f2f2;';
        $inforSucursales = $this->model('Sucursal')->getInfoSucursal();

        switch($_GET['type']){
            case 1: //DAY    
                foreach($inforSucursales as &$info){
                    $info['ventas'] = $this->model('Sucursal')->getVentasEmpleados($info['CODSUCURSAL'],$_GET['date']);
                    if(count($info['ventas']) > 0){
                        foreach($info['ventas'] as &$detalle){
                            $detalle['detalle'] = $this->model('Sucursal')->detalleDeVentaDeEmpleados($detalle['CODVENTA']);
                        }
                    }
                }
                break;
            case 2: //WEEK
                foreach($inforSucursales as &$info){
                    $info['ventas'] = $this->model('Sucursal')->getVentasEmpleadosForWeek($info['CODSUCURSAL'],$_GET['inicio'],$_GET['fin']);
                    if(count($info['ventas']) > 0){
                        foreach($info['ventas'] as &$detalle){
                            $detalle['detalle'] = $this->model('Sucursal')->detalleDeVentaDeEmpleados($detalle['CODVENTA']);
                        }
                    }
                }
                break;
            case 3: //MONTH
                foreach($inforSucursales as &$info){
                    $info['ventas'] = $this->model('Sucursal')->getVentasEmpleadosForMonth($info['CODSUCURSAL'],$_GET['year'],$_GET['month']);
                    if(count($info['ventas']) > 0){
                        foreach($info['ventas'] as &$detalle){
                            $detalle['detalle'] = $this->model('Sucursal')->detalleDeVentaDeEmpleados($detalle['CODVENTA']);
                        }
                    }
                }
        }
        define('ALLDATE',$inforSucursales);

        print_r(ALLDATE);
            echo '<br><br><br><br><br>';
            print_r(ALLDATE[0]);
        
            
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="InformeVentasPorSucursal.xls"');
        header('Pragma: no-cache');
        header('Expires: 0');        
        echo '<table border=1><tr>';

        switch ($_GET['type']){
            case 1:
                $title = "INFORME POR DIA";
                break;
            case 2:
                $title = "INFORME POR SEMANA";
                break;
            case 3:
                $title = "INFORME POR MES";
        }
        
        echo '<th colspan="10" style="font-size: 20px; text-align: center; '.$back_titles.' height: 40px;">'.$title.'</th>';
        
        
        
        foreach(ALLDATE as $sucursal){
            echo '<tr style="text-align:center;"> '
            .'<td colspan="10" style="color: #ffffff; background-color:rgb(92, 143, 211);"><b>Sucursal</b></td>'
            .'</tr>'
            .'<tr style="text-align:center;">'
            .'<td rowspan="2" colspan="10" style="font-size: 20px;">'.$sucursal['NOMBRE'].'</td>'
            .'</tr> <tr></tr>'
            .'<tr style="text-align:center;">'
            .'<td colspan="4" style="'.$back_titles.'"><b>Encargado</b></td>'
            .'<td colspan="3" style="'.$back_titles.'"><b>Telefono</b></td>'
            .'<td colspan="3" style="'.$back_titles.'"><b>Fecha</b></td>'
            .'</tr>';

            echo '<tr style="text-align: center;">'
            .'<td colspan="4">'.$sucursal['ENCARGADO'].'</td>'
            .'<td colspan="3">'.$sucursal['TELEFONO'].'</td>';

            switch($_GET['type']){
                case 1:
                    $fecha = $_GET['date'];
                break;
                case 2:
                    $fecha = $_GET['inicio']. ' - '.$_GET['fin'];
                break;
                case 3:
                    $fecha = $_GET['year']. ' - '.$_GET['month'];
            }

            echo '<td colspan="3">'.$fecha.'</td>'
            .'</tr><tr></tr>';

            echo '<tr><td colspan="10" style="text-align:center; '.$back_titles.'"><b>VENTAS</b></td></tr><tr></tr>';
 

            if(count($sucursal['ventas']) > 0 ){    
                foreach($sucursal['ventas'] as $venta){
                    
                    if($venta['TIPO_VENTA'] == 1){
                        $tipo_venta = 'Rollo(s)'; 
                        $tipo_venta_bool = true ; 
                    }else{
                        $tipo_venta = 'Metro(s)' ; 
                        $tipo_venta_bool = false ; 
                    }

                    echo 
                    '<tr style="text-align:center;">'
                    .'<td colspan="4" style="'.$back_titles.'"><b>Vendedor</b></td>';

                    $titleTimeDate = ($_GET['type'] == 1)? 'Hora': 'Fecha / Hora';
                    $timeDate = ($_GET['type'] == 1)? $venta['HORA_VENTA'] : $venta['FECHA_VENTA'];
                    echo '<td style="'.$back_titles.'"><b>'.$titleTimeDate.'</b></td>'
                    .'<td style="'.$back_titles.'"><b>Unidad de venta</b></td>'
                    .'<td style="'.$back_titles.'"><b>Descuento (%)</b></td>'
                    .'</tr>'
                    .'<tr style="text-align:center;">'
                    .'<td colspan="4"> '.$venta['NOMBRE'].'</td>'
                    .'<td >'.$timeDate.'</td>'
                    .'<td >'.$tipo_venta.'</td>'
                    .'<td >'.$venta['DESCUENTO'].'</td>'
                    .'</tr>'.
                    '<tr><td colspan="10" style="text-align:center;'.$back_titles.'"><b>DETALLE DE LA VENTA</b></td></tr>';
                    $totalVenta = 0;
                    $totalGanancia = 0;
                    echo
                    '<tr style="text-align:center;">'
                        .'<td colspan="2" style="'.$back_titles.'"><b>Tela</b></td>'
                        .'<td  style="'.$back_titles.'"><b>Color</b></td>'
                        .'<td colspan="2" style="'.$back_titles.'"><b>Marca</b></td>'
                        .'<td style="'.$back_titles.'"><b>Cantidad</b></td>'
                        .'<td style="'.$back_titles.'"><b>Precio real</b></td>'
                        .'<td style="'.$back_titles.'"><b>Precio de venta</b></td>'
                        .'<td style="'.$back_titles.'"><b>Sub. Total</b></td>'
                        .'<td style="'.$back_titles.'"><b>Ganancia</b></td>'
                        .'</tr>';
                    foreach($venta['detalle'] as $detalle){
                        if($tipo_venta_bool){
                            $detalle['CANTIDAD'] /= $detalle['MROLLOCOMPLETO'];
                            $detalle['PRECIOR'] = $detalle['PRECIOROLLOREAL'];
                        }
                        $subtotal = $detalle['CANTIDAD']*$detalle['PRECIOV'];
                        $ganancia = $subtotal - $detalle['CANTIDAD']*$detalle['PRECIOR'] ;
                        $totalVenta += $subtotal;
                        $totalGanancia += $ganancia;
                        
                        echo 
                        '<tr style="text-align:center;">'
                        .'<td colspan="2" >'.$detalle['TELA'].'</td>'
                        .'<td  style="background:  '.$detalle['CODCOLOR'].'"></td>'
                        .'<td colspan="2">'.$detalle['MARCA'].'</td>'
                        .'<td>'.$detalle['CANTIDAD'].'</td>'
                        .'<td>'.$detalle['PRECIOR'].'</td>'
                        .'<td>'.$detalle['PRECIOV'].'</td>'
                        .'<td>'.$subtotal.'</td>'
                        .'<td>'.$ganancia.'</td>'
                        .'</tr>';
                    }
                    if($venta['DESCUENTO']!=0){
                        $totalGanancia = ($totalVenta - ($totalVenta*$venta['DESCUENTO']/100)) - $totalGanancia;
                    }

                        echo
                        '<tr></tr><tr><tr style="text-align:center;">'
                        .'<td style="'.$back_titles.'">Sub. Total final</td>'
                        .'<td > '.$totalVenta.'</td>'
                        .'<td >'.$totalGanancia.'</td>'
                        .'</tr>'
                        
                        .'<tr style="text-align:center;">'
                        .'<td style="'.$back_titles.'">Descuento</td>'
                        .'<td >'.$venta['DESCUENTO'].' %</td>'
                        .'<td > - - </td>'
                        .'</tr>'
                        
                        .'<tr style="text-align:center;">'
                        .'<td style="'.$back_titles.'">Total</td>'
                        .'<td >'.$totalVenta - ($totalVenta*$venta['DESCUENTO']/100).'</td>'
                        .'<td >'.$totalGanancia.'</td>'

                        .'</tr>'
                        ;
                    
                    echo '<tr></tr>';
                }
            }else{
            echo '<tr><td colspan="10" style="text-align:center; background:rgb(229, 255, 0);"><b>SIN VENTAS</b></td></tr><tr></tr>';
            }
            echo '<tr></tr><tr></tr>';           
        }
        echo '</table>';
    }

/*
    public function clientesToExcel(){
        $back_titles = 'background-color: #f2f2f2;';
        $infoClientes = $this->model('Cliente')->getInfoClientes();


        switch($_GET['type']){
            case 1: //DAY
                foreach($infoClientes as &$info){
                    
                    $info['compras'] = $this->model('Cliente')->getComprasClienteForReport($info['IDCLIENTE'],$_GET['date']);
                    if(count($info['compras']) > 0){
                        foreach($info['compras'] as &$detalle){
                            $detalle['detalle'] = $this->model('Sucursal')->detalleDeVentaDeEmpleados($detalle['CODVENTA']);
                        }
                    }
                }
                break;
            case 2: //WEEK
                foreach($infoClientes as &$info){
                    $info['compras'] = $this->model('Cliente')->getComprasClientesForWeek($info['IDCLIENTE'],$_GET['inicio'],$_GET['fin']);
                    if(count($info['compras']) > 0){
                        foreach($info['compras'] as &$detalle){
                            $detalle['detalle'] = $this->model('Sucursal')->detalleDeVentaDeEmpleados($detalle['CODVENTA']);
                        }
                    }
                }
                break;
            case 3: //MONTH
                foreach($infoClientes as &$info){
                    $info['compras'] = $this->model('Cliente')->getComprasClienteForMonth($info['IDCLIENTE'],$_GET['year'],$_GET['month']);
                    if(count($info['compras']) > 0){
                        foreach($info['compras'] as &$detalle){
                            $detalle['detalle'] = $this->model('Sucursal')->detalleDeVentaDeEmpleados($detalle['CODVENTA']);
                        }
                    }
                }
        }

        define('ALLDATE',$infoClientes);
        
        
        print_r(ALLDATE);
            echo '<br><br><br><br><br>';
            print_r(ALLDATE[0]);
        
        error_reporting(0);
        
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="informeCompraClientes.xls"');
        header('Pragma: no-cache');
        header('Expires: 0');        
        echo '<table border=1><tr>';
        
        switch ($_GET['type']){
            case 1:
                $title = "INFORME DE COMPRAS POR DIA";
                break;
                case 2:
                    $title = "INFORME DE COMPRAS POR SEMANA";
                break;
            case 3:
                $title = "INFORME DE COMPRAS POR MES";
            }
            
                
        echo '<th colspan="10" style="font-size: 20px; text-align: center; '.$back_titles.' height: 40px;">'.$title.'</th>';
            
        foreach(ALLDATE as $sucursal){
            
            echo '<tr style="text-align:center;">'
            .'<td rowspan="2" colspan="10" style="font-size: 20px;">'.$sucursal['NOMBRE'].'</td>'
            .'</tr> <tr></tr>'
            .'<tr style="text-align:center;">'
            .'<td colspan="4" style="'.$back_titles.'"><b>Cliente</b></td>'
            .'<td colspan="2" style="'.$back_titles.'"><b>Telefono</b></td>'
            .'<td colspan="2" style="'.$back_titles.'"><b>CI / NIT</b></td>'
            .'<td colspan="1" style="'.$back_titles.'"><b>Tipo de cliente</b></td>'
            .'<td colspan="1" style="'.$back_titles.'"><b># Compras</b></td>'
            .'</tr>';

            echo '<tr style="text-align: center;">'
            .'<td colspan="4">'.$sucursal['RAZONSOCIAL'].'</td>'
            .'<td colspan="2">'.$sucursal['TELEFONO'].'</td>'
            .'<td colspan="2">'.$sucursal['CI_NIT'].'</td>'
            .'<td colspan="1">'. strtoupper( $sucursal['CODTIPO']).'</td>'
            .'<td colspan="1">'.count($sucursal['compras']).'</td>';


            $iter = 1;
            if(count($sucursal['compras']) > 0 ){    
                foreach($sucursal['compras'] as $venta){
                    echo '<tr><td colspan="10" style="text-align:center; '.$back_titles.'"><b>COMPRA # '.$iter++.'</b></td></tr><tr></tr>';
                    
                    if($venta['TIPO_VENTA'] == 1){
                        $tipo_venta = 'Rollo(s)'; 
                        $tipo_venta_bool = true ; 
                    }else{
                        $tipo_venta = 'Metro(s)' ; 
                        $tipo_venta_bool = false ; 
                    }

                    echo 
                    '<tr style="text-align:center;">'
                    .'<td colspan="4" style="'.$back_titles.'"><b>Vendedor</b></td>'
                    .'<td colspan="3" style="'.$back_titles.'"><b>Sucursal</b></td>';


                    $titleTimeDate = ($_GET['type'] == 1)? 'Hora': 'Fecha / Hora';
                    $timeDate = ($_GET['type'] == 1)? $venta['HORA_VENTA'] : $venta['FECHA_VENTA'];
                    echo '<td style="'.$back_titles.'"><b>'.$titleTimeDate.'</b></td>'
                    .'<td style="'.$back_titles.'"><b>Unidad de venta</b></td>'
                    .'<td style="'.$back_titles.'"><b>Descuento (%)</b></td>'
                    .'</tr>'

                    .'<tr style="text-align:center;">'
                    .'<td colspan="4"> '.$venta['NOMBRE'].'</td>'
                    .'<td colspan="3"> '.$venta['SUCURSAL'].'</td>'
                    .'<td >'.$timeDate.'</td>'
                    .'<td >'.$tipo_venta.'</td>'
                    .'<td >'.$venta['DESCUENTO'].'</td>'
                    .'</tr>'.
                    '<tr><td colspan="10" style="text-align:center;'.$back_titles.'"><b>DETALLE DE LA COMPRA</b></td></tr>';
                    $totalVenta = 0;
                    $totalGanancia = 0;
                    echo
                    '<tr style="text-align:center;">'
                        .'<td colspan="2" style="'.$back_titles.'"><b>Tela</b></td>'
                        .'<td  style="'.$back_titles.'"><b>Color</b></td>'
                        .'<td colspan="2" style="'.$back_titles.'"><b>Marca</b></td>'
                        .'<td style="'.$back_titles.'"><b>Cantidad</b></td>'
                        .'<td style="'.$back_titles.'"><b>Precio real</b></td>'
                        .'<td style="'.$back_titles.'"><b>Precio de venta</b></td>'
                        .'<td style="'.$back_titles.'"><b>Sub. Total</b></td>'
                        .'<td style="'.$back_titles.'"><b>Ganancia</b></td>'
                        .'</tr>';
                    foreach($venta['detalle'] as $detalle){
                        if($tipo_venta_bool){
                            $detalle['CANTIDAD'] /= $detalle['MROLLOCOMPLETO'];
                            $detalle['PRECIOR'] = $detalle['PRECIOROLLOREAL'];
                        }
                        $subtotal = $detalle['CANTIDAD']*$detalle['PRECIOV'];
                        $ganancia = $subtotal - $detalle['CANTIDAD']*$detalle['PRECIOR'] ;
                        $totalVenta += $subtotal;
                        $totalGanancia += $ganancia;
                        
                        echo 
                        '<tr style="text-align:center;">'
                        .'<td colspan="2" >'.$detalle['TELA'].'</td>'
                        .'<td  style="background:  '.$detalle['CODCOLOR'].'"></td>'
                        .'<td colspan="2">'.$detalle['MARCA'].'</td>'
                        .'<td>'.$detalle['CANTIDAD'].'</td>'
                        .'<td>'.$detalle['PRECIOR'].'</td>'
                        .'<td>'.$detalle['PRECIOV'].'</td>'
                        .'<td>'.$subtotal.'</td>'
                        .'<td>'.$ganancia.'</td>'
                        .'</tr>';
                    }
                    if($venta['DESCUENTO']!=0){
                        $totalGanancia = ($totalVenta - ($totalVenta*$venta['DESCUENTO']/100)) - $totalGanancia;
                    }

                        echo
                        '<tr></tr><tr><tr style="text-align:center;">'
                        .'<td style="'.$back_titles.'">Sub. Total final</td>'
                        .'<td > '.$totalVenta.'</td>'
                        .'<td >'.$totalGanancia.'</td>'
                        .'</tr>'
                        
                        .'<tr style="text-align:center;">'
                        .'<td style="'.$back_titles.'">Descuento</td>'
                        .'<td >'.$venta['DESCUENTO'].' %</td>'
                        .'<td > - - </td>'
                        .'</tr>'
                        
                        .'<tr style="text-align:center;">'
                        .'<td style="'.$back_titles.'">Total</td>'
                        .'<td >'.$totalVenta - ($totalVenta*$venta['DESCUENTO']/100).'</td>'
                        .'<td >'.$totalGanancia.'</td>'

                        .'</tr>'
                        ;
                    
                    echo '<tr></tr>';
                }
            }else{
            echo '<tr><td colspan="10" style="text-align:center; background:rgb(229, 255, 0);"><b>SIN COMPRAS</b></td></tr><tr></tr>';
            }
            echo '<tr></tr><tr></tr>';           
        }
        echo '</table>';
    }
    */
}