<?php
class Contrato extends Controller
{
    public function index()
    {
        $model = $this->model('Contrato');
        $this->view('contrato/contrato', $model->view());
    }

    public function form()
    {
        session_start();
        $tela = $this->model('Tela')->getForSucursal($_SESSION['cod_sucursal']);
        $cliente = $this->model('Cliente')->view();
        $this->view('contrato/form', $tela, $cliente);
    }

    public function create()
    {
        print_r($_POST);
        session_start();

        $model = $this->model('Contrato');
        $modelTela = $this->model('Tela');

        $tela = $modelTela->find_stock($_POST['color'],$_POST['codtela']);
        $totalTela = ($tela['NUMROLLOS']==0? 1 : $tela['NUMROLLOS']) * $tela['MROLLOCOMPLETO'] + ($tela['METROLLO'] == $tela['MROLLOCOMPLETO']? 0 : $tela['METROLLO']);
        
        if($_POST['metros_tela'] <= $totalTela){
            $data = [
                'PERSONAL' => $_SESSION['id'],
                'CLIENTE' => $_POST['cliente'],
                'TELA' => $_POST['codtela'],
                'SASTRE' => 'NO DEFINIDO',
                'C_SASTRE' => $_POST['precio_sastre'],
                'M_TELA' => $_POST['metros_tela'],
                'C_TELA' => $_POST['precio_tela'],
                'FRUNCIDO' => $_POST['frunsido'],
                'C_COLOR' => $_POST['color'],
                'FECHA_ENTREGA' => $_POST['fecha_entrega'],
                'DESCRI' => $_POST['descripcion'],
            ];
            $id_contrato = $model->create($data);
  
  
            if($_POST['costoTubo']!=''){

            $data = [
                'ID' => $id_contrato,
                'mTubo' => $_POST['medidaTubo'],
                'numVentanas' => $_POST['numVentanas'],
                'costoTubo' => $_POST['costoTubo'],
                'numHerrajes' => $_POST['numHerrajes'],
                'costoHerraje' => $_POST['costoHerraje'],
                'manoInsta' => $_POST['manoInsta']
            ];
              $model->meterial_instalacion($data);  
            }
            
            if ($id_contrato != 0) {
                for ($i = 0; $i < $_POST['total']; $i++) {
                $data = [
                    'CODCONTRATO' => $id_contrato,
                    'ALTO' => $_POST['alto' . $i],
                    'ANCHO' => $_POST['ancho' . $i],
                    'CANT' => $_POST['cantidad' . $i],
                ];
                $model->create_detalle($data);
                }
            }

     
            $modelVenta = $this->model('Venta');
        
            $id = $modelVenta->create_venta([
                'IDP' => $_SESSION['id'],
                'CODCLI' => $_POST['cliente'],
                'SUCU' => $_SESSION['cod_sucursal'],
                'DESCUENTO' => 0
            ]);
        
            $modelVenta->create_detalle_venta(
                [
                    'CODV' => $id,
                    'CODT' => $_POST['codtela'],
                    'CODC' => $_POST['color'],
                    'PRE' => $_POST['precioTelaOriginal'],
                    'CANT' => $_POST['metros_tela'],
                ]
            );
        }else{
            $_SESSION['error_contrato'] = 'No hay suficiente tela para concretar el contato';
        }

        header('Location: /' . APP_NAME . '/Contrato');
    }
    public function delete()
    {
        $model = $this->model('Contrato');

        if($model->delete($_GET['id'])){
            $this->messageDelete();
        }else{
            $this->messageNoDelete();
        }

       header('Location: /' . APP_NAME . '/Contrato');
    }

    public function detail()
    {
        $model = $this->model('Contrato');
        $this->view('contrato/detail', $model->contrato($_GET['id']), $model->get_detalle_contrato($_GET['id']), $model->get_material_instalacion($_GET['id']));
    }
    public function estado()
    {
        $model = $this->model('Contrato');

        $model->setEstado($_GET['id']);
        header('Location: /' . APP_NAME . '/Contrato');

    }


    public function pdf()
    {
        $model = $this->model('Contrato');
        $contrato = $model->contrato($_GET['id']);
        $detalle = $model->get_detalle_contrato($_GET['id']);
        $material_instalacion = $model->get_material_instalacion($_GET['id']);


        //print_r($contrato);
        $cantidadTotal = 0;

        $pdf = new FPDF();
        $pdf->AddPage('P', array(215.9, 279.4));

        // Datos de la empresa en la esquina superior derecha
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetY(10);
        $pdf->Cell(0, 4, COMPANY_NAME, 0, 1, 'L');
        $pdf->Cell(0, 4, ADDRESS_COMPANY, 0, 1, 'L');
        $pdf->Cell(0, 4, PHONE_COMPANY, 0, 1, 'L');
        $pdf->Cell(0, 4, EMAIL_COMPANY, 0, 1, 'L');

        $pdf->Image('../public/img/importadora.png', $pdf->SetX(46 * 4), 10, 15);
        //img logo



        // Espacio para el título
        $pdf->Ln(2);
        $pdf->SetFont('Arial', 'B', 18);
        $pdf->Cell(0, 10, 'CONTRATO', 0, 1, 'C');

        $pdf->SetDrawColor(0, 0, 0); // Color negro
        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); // Línea horizontal

        // Espacio para datos adicionales

        $pdf->Ln(1);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell($pdf->GetPageWidth() / 2 - $pdf->GetX(), 5, 'PERSONAL', 0, 1, 'C');
        $pdf->Cell($pdf->GetPageWidth() / 2 - $pdf->GetX(), 5, 'Responsable: ' . $contrato['EMPLEADO'], 0, 1, 'L');
        $pdf->Cell($pdf->GetPageWidth() / 2 - $pdf->GetX(), 5, 'Celular:' . $contrato['CELULAR'], 0, 0, 'L');
        $pdf->Ln();
        
        //$pdf->SetX()
        $pdf->SetY($pdf->GetY() - 15);
        $pdf->SetX($pdf->GetPageWidth() / 2);

        $pdf->Cell($pdf->GetPageWidth() / 2 - $pdf->GetX(), 5, 'CLIENTE', 0, 1, 'C');
        $pdf->SetX($pdf->GetPageWidth() / 2);
        $pdf->Cell($pdf->GetPageWidth() / 2 - $pdf->GetX(), 5, 'Nombre: ' . $contrato['RAZONSOCIAL'], 0, 1, 'L');

        $pdf->SetX($pdf->GetPageWidth() / 2);
        $pdf->Cell($pdf->GetPageWidth() / 2 - $pdf->GetX(), 5, 'Celular:' . $contrato['TELEFONO'], 0, 1, 'L');

        $pdf->SetX($pdf->GetPageWidth() / 2);
        $pdf->Cell($pdf->GetPageWidth() / 2 - $pdf->GetX(), 5, 'Tipo: ' . ucwords($contrato['CODTIPO']), 0, 1, 'L');

        $x1 = $pdf->GetPageWidth() / 2; // Coordenada X del inicio de la línea
        $y1 = 38; // Coordenada Y del inicio de la línea
        // Coordenada X del final de la línea (igual a x1 para una línea vertical)
        $y2 = $y1 + 21; // Coordenada Y del final de la línea
        $pdf->Line($x1, $y1, $x1, $y2);

        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); // Línea horizontal


        $pdf->Ln();
        $pdf->Cell(0, 5, 'DETALLES DE LA TELA', 0, 1, 'C');
        $pdf->Cell(0, 5, 'Nombre: ' . $contrato['NOMBRE'], 0, 1, 'L');

        $pdf->Cell(0, 5, 'Marca: ' . $contrato['MARCA'], 0, 1, 'L');
        $pdf->Cell(0, 5, 'Calidad: ' . $contrato['CALIDAD'], 0, 1, 'L');
        
        
        $pdf->Cell(0, 5, 'Cantidad (m.): ' . $contrato['METROS_TELA'], 0, 1, 'L');
        
        $pdf->Cell(0, 5, 'Costo de la tela: Bs. '.$contrato['COSTO_TOTAL_TELA'] , 0, 1, 'C');
        

        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); // Línea horizontal
        $pdf->Ln();
        $pdf->Cell(0, 5, 'DETALLES', 0, 1, 'C');
        $pdf->Ln();

        
        $pdf->Cell(0, 5, 'Fruncido: (cm.): ' . $contrato['FRUNCIDO'] , 0, 1, 'C');
        $pdf->Cell(100, 5, 'Fecha inicio contratro: ' . $contrato['FECHA_INICIO'] , 0, 0, 'L');
        $pdf->Cell(0, 5, 'Fecha fin contratro: ' . $contrato['FECHA_ENTREGA'] , 0, 1, 'L');
        
        $pdf->Ln();


$pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); // Línea horizontal
$pdf->Cell(0, 5,  'MATERIAL E INSTALACION', 0, 1, 'C');
if($material_instalacion['c_tubo'] != 0){
$pdf->Cell(0, 5, '# Ventanas: ' . $material_instalacion['ventanas'], 0, 1, 'L');
$pdf->Cell(0, 5, 'Tubo (m): ' . $material_instalacion['metrosTubo'], 0, 1, 'L');
$pdf->Cell(0, 5, 'Costo Tubo (Bs.): ' . $material_instalacion['c_tubo'] * $material_instalacion['metrosTubo'] , 0, 1, 'L');
$pdf->Cell(0, 5, '# Herraje: ' . $material_instalacion['numHerraje'] , 0, 1, 'L');
$pdf->Cell(0, 5, 'Costo Herraje: ' . $material_instalacion['numHerraje'] * $material_instalacion['c_herraje'], 0, 1, 'L');
}else{
$pdf->Cell(0, 5, 'SIN MATERIAL DE INSTALACION', 0, 1, 'C');
}
if($material_instalacion['c_instalacion'] != 0){
    $pdf->Cell(0, 5, 'COSTO INSTALACION: '.$material_instalacion['c_instalacion'], 0, 1, 'C');
}else{
$pdf->Cell(0, 5, 'SIN INSTALACION', 0, 1, 'C');
}

        //print_r($material_instalacion);

        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); // Línea horizontal


        
        $pdf->Cell(0, 5, 'DIMENSIONES DE LAS CORTINAS', 0, 1, 'C');


        $pdf->Ln(2);



        $header = array('ALTO (m.)', 'ANCHO (m.)', 'CANTIDAD');
        $pdf->SetFillColor(200, 220, 255); // Color de fondo para los encabezados
        foreach ($header as $h) {
            $pdf->Cell($pdf->GetPageWidth() / 3 - 8, 10, $h, 1, 0, 'C', true);
        }
        $pdf->Ln();

        foreach ($detalle as $row) {
            $pdf->Cell($pdf->GetPageWidth() / 3 - 8, 10, $row['ALTO'], 1, 0, 'C');
            $pdf->Cell($pdf->GetPageWidth() / 3 - 8, 10, $row['ANCHO'], 1, 0, 'C');
            $pdf->Cell($pdf->GetPageWidth() / 3 - 8, 10, $row['CANTIDAD'], 1, 0, 'C');

            $pdf->Ln();
            $cantidadTotal += $row['CANTIDAD'];
        }


        $pdf->SetX($pdf->getX() + $pdf->GetPageWidth() / 3 - 8);
        $pdf->SetFillColor(200, 220, 255); // Color de fondo para los encabezados

        $pdf->Cell($pdf->GetPageWidth() / 3 - 8, 10, 'TOTAL', 1, 0, 'C', true);
        $pdf->Cell($pdf->GetPageWidth() / 3 - 8, 10, $cantidadTotal, 1, 1, 'C');

        $pdf->Ln();
        $pdf->Cell(0, 5, 'DESCRIPCION', 0, 1, 'C');

        $pdf->MultiCell(0, 5, $contrato['DESCRIPCION']);



        $pdf->Ln(5);
        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); // Línea horizontal


        $pdf->Ln();
        $pdf->Cell(0, 5, 'COBRO Y SALDO', 0, 1, 'C');
        $pdf->Ln();

        $pdf->MultiCell(0, 5, 'Monto total: '.$contrato['COSTO_TOTAL_TELA'] + $material_instalacion['c_tubo'] + $material_instalacion['c_herraje'] + $material_instalacion['c_instalacion'].' Bs. , monto cancelado : Bs......................................... y Saldo: Bs........................................');



        $pdf->SetFont('Arial', 'B');
        
        if($pdf->GetY()+30 < 280){
            $pdf->SetY(15 + $pdf->GetY());
            $pdf->Cell($pdf->GetPageWidth() - 20, 5,'..............................................', 0, 1, 'C');
            $pdf->Cell($pdf->GetPageWidth() - 20, 6, $contrato['RAZONSOCIAL'], 0, 1, 'C');
            $pdf->Cell($pdf->GetPageWidth() - 20, 8, 'CLIENTE', 0, 1, 'C');
        }


        // Salvar el archivo PDF o enviarlo al navegador
        $pdf->Output('I', 'hoja_membretada.pdf');
    }

    public function tela()
    {
        $this->view('contrato/contratoTela');
    }

    public function formTela(){
        $tela = $this->model('Tela')->getTelas();
        $cliente = $this->model('Cliente')->view();      
        $this->view('contrato/formTela',$tela,$cliente);
    }
}
?>