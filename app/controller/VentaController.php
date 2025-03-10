<?php
class Venta extends Controller
{
    public function index()
    {
        //error_reporting(0);            
        session_start();
        $model = $this->model('Venta');
        $ventas = [];
        switch ($_SESSION['rol']) {
            case 1:
                $ventas = $model->all_sells();
                break;
            case 2:
                $ventas = $model->sells_sucursal($_SESSION['cod_sucursal']);
                break;
            case 3:
                $ventas = $model->my_sells($_SESSION['id']);

        }
        $this->view('venta/venta', $ventas);
    }
    public function form()
    {
        $telas = $this->model('Tela');
        //print_r($telas->getAll());
        $clientes = $this->model('Cliente');
        $this->view('Venta/form', $telas->getAll(), $clientes->view());
    }
    public function formRollos(){
        $telas = $this->model('Tela');
        //print_r($telas->getAll());
        $clientes = $this->model('Cliente');
        $this->view('Venta/formRollo', $telas->getAll(), $clientes->view());
    }
    public function create()
    {
        error_reporting(0);
        session_start();
        $model = $this->model('Venta');
        
        $id = $model->create_venta([
            'IDP' => $_SESSION['id'],
            'CODCLI' => $_POST['clinte'],
            'SUCU' => $_SESSION['cod_sucursal'],
            'DESCUENTO' => $_POST['descuento']
        ]);
        
        for ($i = 0; $i < $_POST['total']; $i++) {
            $model->create_detalle_venta(
                [
                    'CODV' => $id,
                    'CODT' => $_POST['codtela' . $i],
                    'CODC' => $_POST['codcolor' . $i],
                    'PRE' => $_POST['precio' . $i],
                    'CANT' => $_POST['cantidad' . $i],
                ]
            );
        }

        header('Location: /' . APP_NAME . '/Venta');
    }

    public function create_venta_rollos()
    {
        error_reporting(0);
        session_start();
        $model = $this->model('Venta');
        $TELA = $this->model('Tela');

        
        
        $id = $model->create_venta_rollo([
            'IDP' => $_SESSION['id'],
            'CODCLI' => $_POST['clinte'],
            'SUCU' => $_SESSION['cod_sucursal'],
            'DESCUENTO' => $_POST['descuento'],
            'TIPO_VENTA' => 1
        ]);
        print_r($_POST);
        for ($i = 0; $i < $_POST['total']; $i++) {
            $rolloCompleto = $TELA->get_by_color_and_cod($_POST['codcolor'.$i],$_POST['codtela'.$i])['MROLLOCOMPLETO'];
            
            $model->create_detalle_venta(
                [
                    'CODV' => $id,
                    'CODT' => $_POST['codtela' . $i],
                    'CODC' => $_POST['codcolor' . $i],
                    'PRE' => $_POST['precio' . $i],
                    'CANT' => $_POST['cantidad'.$i]*$rolloCompleto,
                    ]
                );

        }

        header('Location: /' . APP_NAME . '/Venta');
    }
    public function delete()
    {
        session_start();
        $model = $this->model('Venta');
        if ($model->delete($_GET['id'])) {
            $this->messageDelete();
        } else {
            $this->messageNoDelete();
        }

        header('Location: /' . APP_NAME . '/Venta');
    }
    public function update()
    {
        $model = $this->model('cargo');
        $datos = $model->getCargo($_GET['id']);
        $this->view('cargo/formUpdate', $datos);
    }
    public function save()
    {
        session_start();
        $data = [
            'ID' => $_POST['id'],
            'DESCRI' => $_POST['descri']
        ];
        $model = $this->model('Cargo');
        $model->update($data);

        $_SESSION['title'] = 'MODIFICADO';
        $_SESSION['msg'] = 'Datos del usuario actualizados';
        header('Location: /' . APP_NAME . '/usuario');
    }
    public function getTela()
    {
        $model = $this->model('Tela');

        $data = $model->getTela_idColor($_POST['id'], $_POST['color']);

        header('Content-Type: application/json');

        // Enviar la respuesta
        echo json_encode($data);


    }
    public function detail()
    {
        $model = $this->model('Venta');

        $detalle_general = $model->detail($_GET['id']);
        $detalle_descrip = $model->detailProductsSells($_GET['id']);
        
        if($detalle_general['TIPO_VENTA']){
            foreach($detalle_descrip as &$dd){
                $dd['CANTIDAD'] /= $this->model('Tela')->get_by_color_and_cod($dd['CODCOLOR'],$dd['CODTELA'])['MROLLOCOMPLETO']; 
            }
        }

        $this->view('venta/detail', $detalle_general, $detalle_descrip);
    }
    
    public function pdf()
    {
        $model = $this->model('Venta');
        $compra = $model->detail($_GET['id']);
        
        $detalle = $model->detailProductsSells($_GET['id']);
        if($compra['TIPO_VENTA']){
            $total = $precioCantidadRollo = $model->totalRollosAndPrecio($_GET['id']);
            $monto_del_recibo =[
                'completo' => number_format($precioCantidadRollo['TOTAL'] - $precioCantidadRollo['TOTAL']*($compra['DESCUENTO']/100),1),
                'entero' => floor($precioCantidadRollo['TOTAL'] - $precioCantidadRollo['TOTAL']*($compra['DESCUENTO']/100)),
                'ctvs' => number_format( fmod($precioCantidadRollo['TOTAL'] - $precioCantidadRollo['TOTAL']*($compra['DESCUENTO']/100),1),1)*100
            ] ;
        }else{
            $precio = $model->totalProducts($_GET['id']);
            $total = $model->totalMetros($_GET['id']);
            $monto_del_recibo =[
                'completo' => number_format($precio['TOTAL'] - $precio['TOTAL']*($compra['DESCUENTO']/100),1),
                'entero' => floor($precio['TOTAL'] - $precio['TOTAL']*($compra['DESCUENTO']/100)),
                'ctvs' => number_format( fmod($precio['TOTAL'] - $precio['TOTAL']*($compra['DESCUENTO']/100),1),1)*100
            ] ;
        }
        
        $cantidadTotal = 0;  
        $formatter = new NumberFormatter('es_ES', NumberFormatter::SPELLOUT);
        $pdf = new FPDF();
        $pdf->AddPage('L', array(100, 170));
        $pdf->SetMargins(5, 0, 0);

        $pdf->SetFont('Arial', '', 12);

        $pdf->SetDrawColor(0, 0, 0);
        $pdf->Line(3, 3, 167, 3);
        $pdf->Line(3, 3, 3, 97);
        $pdf->Line(3, 97, 167, 97);
        $pdf->Line(167, 97, 167, 3);

        $pdf->SetFillColor(0, 0, 0);


        $pdf->SetXY(5, 5); // Posicionar el cursor debajo de la línea

        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(10, 5, 'Dia', 1, 0, 'C', true);
        $pdf->Cell(10, 5, 'Mes', 1, 0, 'C', true);
        $pdf->Cell(10, 5, utf8_decode('Año'), 1, 1, 'C', true);
        $pdf->SetTextColor(0, 0, 0);


        $pdf->Cell(10, 5, date('d', strtotime($compra['FECHA_VENTA'])), 1, 0, 'C');
        $pdf->Cell(10, 5, date('m', strtotime($compra['FECHA_VENTA'])), 1, 0, 'C');
        $pdf->Cell(10, 5, date('y', strtotime($compra['FECHA_VENTA'])), 1, 0, 'C');

        $pdf->SetX($pdf->GetPageWidth() / 2);
        $pdf->Cell(10, 5, utf8_decode('N° 0000') . $compra['CODVENTA'], 0, 1, 'C');

        $pdf->Ln();
        $pdf->SetX($pdf->GetPageWidth() / 2);
        $pdf->SetFont('Arial', '', 25);

        $pdf->SetTextColor(255, 0, 0);
        $pdf->Cell(10, 5, 'RECIBO', 0, 1, 'C');
        $pdf->SetTextColor(0, 0, 0);

        $pdf->SetY(5);
        $pdf->SetX($pdf->GetPageWidth() - 45);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(35, 5, COMPANY_NAME, 0, 1, 'C');
        $pdf->SetX($pdf->GetPageWidth() - 45);


        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(35, 5, 'Telf: ' . PHONE_COMPANY, 0, 1, 'C');
        $pdf->Ln(5);

        $pdf->SetX($pdf->GetPageWidth() - 40);
        $pdf->Cell(35, 5, 'Bs.  ' . $monto_del_recibo['completo'] , 1, 1, 'L');
        $pdf->SetX($pdf->GetPageWidth() - 40);



        $pdf->SetXY(5, 30);
        $pdf->Cell(23, 5, 'Recibi de:', 0, 0, 'L');
        $pdf->Cell(134, 5, $compra['CLIENTE'], 0, 0, 'L');
        $pdf->Line(28, 35, 165, 35);


        $pdf->Ln(10);
        $pdf->Cell(26, 5, 'La suma de:', 0, 0, 'L');
        $pdf->Cell(134, 5, utf8_decode($formatter->format($monto_del_recibo['entero'])) .' '. $monto_del_recibo['ctvs'].'/100', 0, 0, 'L');
        $pdf->Line(30, 45, 165, 45);
        $pdf->Line(6, 55, 144, 55);
        $pdf->SetXY(145, 50);
        $pdf->Cell(26, 5, 'Bolivianos', 0, 0, 'L');


        $pdf->Ln(10);
        $pdf->Cell(35, 5, 'Por concepto de:', 0, 0, 'L');
        $tipo_producto = $compra['TIPO_VENTA']?' Rollo(s) ':' metro(s) ';
        $pdf->Cell(100, 5, $formatter->format($total['METROS']). $tipo_producto.'de tela', 0, 0, 'L');

        $pdf->Line(38, 65, 165, 65);



        $pdf->Ln(14);
        $pdf->SetX(10);
        $pdf->Line(5, 90, 65, 90);
        $pdf->Cell(50, 5, 'Recibi conforme', 0, 0, 'C');

        $pdf->SetX($pdf->GetPageWidth() - 60);
        $pdf->Line(105, 90, 165, 90);
        $pdf->Cell(50, 5, 'Entrege conforme', 0, 0, 'C');


        $pdf->Output('I', 'RECIBO.pdf');
    }

    public function contrato()
    {
        $model = $this->model('Venta');
        $venta = $model->detailForContrat($_GET['id']);

        if($venta['TIPO_VENTA']){
            $detalle = $model->detailProductsSellsRollos($_GET['id']);
        }else{
            $detalle = $model->detailProductsSells($_GET['id']);
        }


        $cantidadTotal = 0;

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
        $pdf->Cell(0, 10, 'CONTRATO', 0, 1, 'C');

        $pdf->SetDrawColor(0, 0, 0); // Color negro
        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); // Línea horizontal

        // Espacio para datos adicionales
        $pdf->Ln(1);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell($pdf->GetPageWidth() / 2 - $pdf->GetX(), 5, 'PERSONAL', 0, 1, 'C');
        $pdf->Cell($pdf->GetPageWidth() / 2 - $pdf->GetX(), 5, 'Responsable: ' . $venta['PERSONAL'], 0, 1, 'L');
        $pdf->Cell($pdf->GetPageWidth() / 2 - $pdf->GetX(), 5, 'Celular:' . $venta['CELULAR'], 0, 0, 'L');
        $pdf->Ln();

        $pdf->SetY($pdf->GetY() - 15);
        $pdf->SetX($pdf->GetPageWidth() / 2);

        $pdf->Cell($pdf->GetPageWidth() / 2 - $pdf->GetX(), 5, 'CLIENTE', 0, 1, 'C');
        $pdf->SetX($pdf->GetPageWidth() / 2);
        $pdf->Cell($pdf->GetPageWidth() / 2 - $pdf->GetX(), 5, 'Nombre: ' . $venta['CLIENTE'], 0, 1, 'L');

        $pdf->SetX($pdf->GetPageWidth() / 2);
        $pdf->Cell($pdf->GetPageWidth() / 2 - $pdf->GetX(), 5, 'Celular:' . $venta['TELEFONO'], 0, 1, 'L');
        $pdf->SetX($pdf->GetPageWidth() / 2);
        $pdf->Cell($pdf->GetPageWidth() / 2 - $pdf->GetX(), 5, 'Tipo: ' . ucwords($venta['CODTIPO']), 0, 1, 'L');
        $x1 = $pdf->GetPageWidth() / 2; // Coordenada X del inicio de la línea
        $y1 = 38; // Coordenada Y del inicio de la línea
        $y2 = $y1 + 21; // Coordenada Y del final de la línea
        $pdf->Line($x1, $y1, $x1, $y2);
        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); // Línea horizontal
        $pdf->Ln();
        $pdf->Cell(0, 5, 'DETALLE DE LOS PRODUCTOS', 0, 1, 'C');
        $pdf->Ln(2);

        $pdf->SetFillColor(200, 220, 255); // Color de fondo para los encabezados

        $pdf->Cell(77, 10, 'NOMBRE', 1, 0, 'C', true);
        $pdf->Cell(18, 10, 'COLOR', 1, 0, 'C', true);
        $pdf->Cell(22, 10, 'CALIDAD', 1, 0, 'C', true);
        $pdf->Cell(20, 10, 'PRECIO', 1, 0, 'C', true);
        $pdf->Cell(26, 10, ($venta['TIPO_VENTA'])?'ROLLOS':'METROS', 1, 0, 'C', true);
        $pdf->Cell(28, 10, 'SUB. TOTAL', 1, 0, 'C', true);

        $pdf->Ln();

        foreach ($detalle as $row) {
            //print_r($row['PRECIO']. ' -> ');

            $pdf->Cell(77, 8, $row['NOMBRE'], 1, 0, 'C');


            list($r, $g, $b) = $this->hexToRgb($row['CODCOLOR']);

            $pdf->SetFillColor($r, $g, $b);

            $x = $pdf->getX() + 4.5;
            $y = $pdf->getY() + 1.5;
            // Dibujar el cuadrado
            $size = 5; // Tamaño del cuadrado en mm
            $pdf->Rect($x, $y, $size * 2, $size, 'F');
            $pdf->Cell(18, 8, '', 1);
           
//            $pdf->Cell(18, 8, $row['CODCOLOR'], 1, 0, 'C');
            $pdf->Cell(22, 8, $row['CALIDAD'] , 1, 0, 'C');
            $pdf->Cell(20, 8, $row['PRECIO'], 1, 0, 'C');
            $pdf->Cell(26, 8, $row['CANTIDAD'], 1, 0, 'C');
            $pdf->Cell(28, 8, $row['PRECIO'] * $row['CANTIDAD'] , 1, 1, 'C');

            $cantidadTotal += $row['CANTIDAD'] * $row['PRECIO'];
        }

        $pdf->SetX(147);
        $pdf->SetFillColor(200, 220, 255); // Color de fondo para los encabezados


        $pdf->Cell(26, 8, 'TOTAL', 1, 0, 'C', true);
        $pdf->Cell(28, 8, $cantidadTotal, 1, 1, 'C');
        
        $pdf->SetX(147);
        
        $pdf->Cell(26, 8, 'DESC.', 1, 0, 'C', true);
        $pdf->Cell(28, 8, $venta['DESCUENTO'].' %', 1, 1, 'C');
        
        $pdf->SetX(147);
        
        $pdf->Cell(26, 8, 'C. FINAL', 1, 0, 'C', true);
        $pdf->Cell(28, 8, $cantidadTotal - $cantidadTotal * ($venta['DESCUENTO']/100), 1, 1, 'C');
        
        
        $pdf->Ln();
        

            $pdf->Ln(5);
            $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); // Línea horizontal
            
            
            
            $pdf->Ln();
            $pdf->Cell(0, 5, 'COBRO Y SALDO', 0, 1, 'C');
            $pdf->Ln();
            
            $pdf->MultiCell(0, 5, 'Monto cancelado : Bs......................................... y Saldo: Bs........................................');
            
            
            
            $pdf->SetY(50 + $pdf->GetY());
            $pdf->SetFont('Arial', 'B');
            $pdf->Cell($pdf->GetPageWidth() - 20, 5, '..............................................', 0, 1, 'C');
            $pdf->Cell($pdf->GetPageWidth() - 20, 6, $venta['PERSONAL'], 0, 1, 'C');
            $pdf->Cell($pdf->GetPageWidth() - 20, 8, 'RESPONSABLE', 0, 1, 'C');
            
            $pdf->Ln(15);
            
            $pdf->Cell($pdf->GetPageWidth() - 20, 5, '..............................................', 0, 1, 'C');
            $pdf->Cell($pdf->GetPageWidth() - 20, 6, $venta['CLIENTE'], 0, 1, 'C');
            $pdf->Cell($pdf->GetPageWidth() - 20, 8, 'CLIENTE', 0, 1, 'C');
            
            $pdf->Output('I', 'CONTRATOTELA.pdf');

    }
    public function hexToRgb($hex)
    {
        $hex = str_replace("#", "", $hex);
        if (strlen($hex) == 6) {
            list($r, $g, $b) = str_split($hex, 2);
        } elseif (strlen($hex) == 3) {
            list($r, $g, $b) = str_split($hex, 1);
            $r .= $r;
            $g .= $g;
            $b .= $b;
        } else {
            return false;
        }
        return array(hexdec($r), hexdec($g), hexdec($b));
    }
}
?>