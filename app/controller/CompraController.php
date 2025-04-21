<?php

class Compra extends Controller
{
    public function index()
    {
        session_start();
        $model = $this->model('Compra');
        switch ($_SESSION['rol']) {
            case 1:
                $this->view('compra/compra', $model->view());
                break;
            case 2:
                $this->view('compra/compra', $model->viewMyContracts($_SESSION['cod_sucursal']));
                break;

        }
    }

    public function form()
    {
        $proveedor = $this->model('Proveedor');
        $marca = $this->model('Marca');
        $tela = $this->model('Producto');
        $this->view('compra/form', $proveedor->view(), $marca->view(),$tela->view());
    }

    public function create()
    {
        session_start();
        error_reporting(0);
        $data = [
            'PERSONAL' => $_SESSION['id'],
            'PROVEE' => $_POST['proveedor']
        ];

        $model = $this->model('Compra');
        $id = $model->create($data);

        for ($i = 0; $i < $_POST['total']; $i++) {
            $model->create_detalle_compra(
                [
                    'CODCOMPRA' => $id,
                    'NOMBRE' => $_POST['nombre' . $i],
                    'CODCOLOR' => $_POST['codcolor' . $i],
                    'CODMARCA' => $_POST['codmarca' . $i],
                    'CALIDAD' => $_POST['codcalidad' . $i],
                    'CANTIDAD' => $_POST['cantidad' . $i]
                ]
            );
        }
        $this->index();
    }


    public function delete()
    {
        error_reporting(0);
        session_start();
        $model = $this->model('Compra');
        if($model->delete($_GET['id'])){
            $_SESSION['title'] = 'ELIMINADO';
            $_SESSION['msg'] = 'Registro de compra eliminado correctamente';
        } else {
            $_SESSION['icon'] = 'error';
            $_SESSION['title'] = 'ERROR';
            $_SESSION['msg'] = 'El registro de la compra forma parte de registro, no puede ser eliminado';
        }

        $this->index();
    }



    public function detail()
    {
        $model = $this->model('Compra');
        $this->view('compra/detail', $model->detail($_GET['id']), $model->detail_compra($_GET['id']));
    }

    public function addStock(){
        $model = $this->model('Compra');
        $this->view('compra/addStock', $model->detail($_GET['id']), $model->detail_compra($_GET['id']));
    }
    public function pdf()
    {
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="hoja_membretada.pdf"');

        $model = $this->model('Compra');
        $compra = $model->detail($_GET['id']);
        $detalle = $model->detail_compra($_GET['id']);

        /*print_r($compra);
        print_r($detalle);*/

        $cantidadTotal = 0;

        $pdf = new FPDF();
        $pdf->AddPage('P', array(215.9, 279.4));

        // Datos de la empresa en la esquina superior derecha
        $pdf->SetFont('Arial', '', 12);
        $pdf->SetY(10);
        $pdf->Cell(0, 4, 'Importadora Fernandez', 0, 1, 'L');
        $pdf->Cell(0, 4, 'Dir. Calle ...', 0, 1, 'L');
        $pdf->Cell(0, 4, 'Contactos: ...', 0, 1, 'L');
        $pdf->Cell(0, 4, 'Correo: import@gmial.com', 0, 1, 'L');

        //img logo

        $pdf->Image('../public/img/importadora.png', $pdf->SetX(46 * 4), 10, 15);


        // Espacio para el título
        $pdf->Ln(2);
        $pdf->SetFont('Arial', 'B', 18);
        $pdf->Cell(0, 10, 'INFORME DE COMPRA DE TELAS', 0, 1, 'C');

        $pdf->SetDrawColor(0, 0, 0); // Color negro
        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); // Línea horizontal

        // Espacio para datos adicionales
        $pdf->Ln(1);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(0, 5, 'Responsable: ' . $compra['COMPRADOR'], 0, 0, 'L');
        $pdf->Cell(0, 5, 'Fecha: ' . $compra['FECHA'], 0, 1, 'R');
        $pdf->Cell(0, 5, 'Proveedor: ' . $compra['PROVEEDOR'], 0, 1, 'L');

        // Línea divisoria
        $pdf->Ln(1);
        $pdf->SetDrawColor(0, 0, 0); // Color negro
        $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY()); // Línea horizontal

        $pdf->Ln(3);

        $header = array('Nombre', 'Marca', 'Color', 'Calidad', 'Cantidad');
        $pdf->SetFillColor(200, 220, 255); // Color de fondo para los encabezados
        foreach ($header as $h) {
            $pdf->Cell(38, 10, $h, 1, 0, 'C', true);

        }
        $pdf->Ln();

        foreach ($detalle as $row) {
            $pdf->Cell(38, 10, $row['NOMBRE'], 1, 0, 'C');
            $pdf->Cell(38, 10, $row['MARCA'], 1, 0, 'C');

            list($r, $g, $b) = $this->hexToRgb($row['CODCOLOR']);

            $pdf->SetFillColor($r, $g, $b);

            $x = $pdf->getX() + 15;
            $y = $pdf->getY() + 3;
            // Dibujar el cuadrado
            $size = 5; // Tamaño del cuadrado en mm
            $pdf->Rect($x, $y, $size * 2, $size, 'F');
            $pdf->Cell(38, 10, '', 1);
            $pdf->Cell(38, 10, $row['CALIDAD'], 1, 0, 'C');
            $pdf->Cell(38, 10, $row['CANTIDAD'], 1, 0, 'C');

            $pdf->Ln();
            $cantidadTotal += $row['CANTIDAD'];
        }


        $pdf->SetX($pdf->getX() + 38 * 3);
        $pdf->SetFillColor(200, 220, 255); // Color de fondo para los encabezados

        $pdf->Cell(38, 10, 'TOTAL', 1, 0, 'C', true);
        $pdf->Cell(38, 10, $cantidadTotal, 1, 1, 'C');



        $pdf->SetFont('Arial', 'B');
        
        if($pdf->GetY()+30 < 280){
            $pdf->SetY(15 + $pdf->GetY());

            $pdf->Cell($pdf->GetPageWidth() - 20, 5, '..............................................', 0, 1, 'C');
            $pdf->Cell($pdf->GetPageWidth() - 20, 6, $compra['COMPRADOR'], 0, 1, 'C');
            $pdf->Cell($pdf->GetPageWidth() - 20, 8, 'RESPONSABLE', 0, 1, 'C');
        }

        $pdf->Output('I', 'hoja_membretada.pdf');
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
    public function concretarPedido() {
        $model = $this->model('Tela');
        
        print_r($_POST);
        session_start();

        
        for($i = 0; $i<$_POST['tam']; $i++){
            
            $data = [
                'NOMBRE' => $_POST[$i.'-nombre'],
                'CALIDAD' => $_POST[$i.'-codcalidad'],
                'MARCA' => $_POST[$i.'-codmarca'],
                'METROS' =>$_POST[$i.'-metroRollo'],
                'PRECIOMETRO' => $_POST[$i.'-precioMetro'],
                'PRECIOMETROREAL'=> (int) ($_POST[$i.'-precioVRollo'] / (int) $_POST[$i.'-metroRollo']),
                'SUCURSAL'=> $_SESSION['cod_sucursal'],
                'PROLLO'  => $_POST[$i.'-precioVRollo'],
                'PROLLOREAL'  => $_POST[$i.'-precioRollo'],
                'COLOR' => $_POST[$i.'-codcolor'],
                'CANTIDAD' => $_POST[$i.'-cantidad'],
            ];
            if($model->checkStockOrNew($data)){//NUEVO
                $model->createDeStock($data);
            }else{
                //agregar a stock existene 
                $codtela = $model->selectTelaForUpdateStock($data);
                $model->updateDeStock($data,$codtela['CODTELA']);
            }   
        }
        $this->model('Compra')->changeStatus($_POST['id']);
        
        header('Location: /'.APP_NAME.'/Compra');
    }
    
}

?>