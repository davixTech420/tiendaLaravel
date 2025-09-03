<?php

namespace App\Http\Controllers;

use App\Models\Calificacion;
use App\Models\Deselist;
use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Comentario;
use App\Models\Cupone;
use App\Models\Producto;
use App\Models\Pedido;
use App\Models\DetallePedido;
use App\Models\User;
use Illuminate\Http\Request;
use FPDF;

class PdfController extends Controller
{
    protected $fpdf;

    public function __construct()
    {
        $this->fpdf = new Fpdf;
    }
    public function footer()
    {
        $this->fpdf->AliasNbPages();
        $this->fpdf->SetY(266);
        $this->fpdf->SetFont('Arial', 'I', 8);
        $this->fpdf->Cell(0, 10, utf8_decode('Página') . $this->fpdf->PageNo() . '/{nb}', 0, 0, 'C');
    }
    public function indexAD(Request $request, User $users)
    {
        if (request()->input('documento') || request()->input('nombre') || request()->input('Estado') || request()->input('telefono') || request()->input('email') || request()->input('apellido')) {
            // Si se están aplicando filtros, realizar la búsqueda
            $users = User::query();
            if (request()->input('documento')) {
                $users->where('documento', 'LIKE', '%' . request()->input('documento') . '%');
            }
            if (request()->input('nombre')) {
                $users->where('name', 'LIKE', '%' .  request()->input('nombre') . '%');
            }
            if (request()->input('apellido')) {
                $users->where('apellido', 'LIKE', '%' . request()->input('apellido') . '%');
            }
            if (request()->input('Estado')) {
                $users->where('Estado', 'LIKE', request()->input('Estado'));
            }
            if (request()->input('telefono')) {
                $users->where('telefono', 'LIKE', '%' . request()->input('telefono') . '%');
            }
            if (request()->input('email')) {
                $users->where('email', 'LIKE', '%' . request()->input('email') . '%');
            }
            $users = $users->paginate();
            $this->fpdf->AddPage();
            $this->fpdf->SetFont('Arial', 'B', 20);
            $this->fpdf->Cell(0, 15, 'Reporte de Administradores', 0, 1, 'C');

            // Separador
            $this->fpdf->SetDrawColor(51, 122, 183);
            $this->fpdf->SetLineWidth(0.5);
            $this->fpdf->Line(10, 48, 200, 48);
            $this->fpdf->Ln(10);
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->SetY(55);
            $this->fpdf->SetX(7);
            $this->fpdf->Cell(14, 10, 'Codigo', 1, 0, 'C');
            $this->fpdf->Cell(22, 10, 'Documento', 1, 0, 'C');
            $this->fpdf->Cell(22, 10, 'Nombre', 1, 0, 'C');
            $this->fpdf->Cell(22, 10, 'Apellido', 1, 0, 'C');
            $this->fpdf->Cell(40, 10, 'Email', 1, 0, 'C');
            $this->fpdf->Cell(20, 10, 'Telefono', 1, 0, 'C');
            $this->fpdf->Cell(40, 10, 'Direccion', 1, 0, 'C');
            $this->fpdf->Cell(18, 10, 'Estado', 1, 1, 'C');
            if ($users->isEmpty()) {
                $this->fpdf->Cell(20, 20, 'No se encuentran resultados', 1, 1, 'C');
            } else {
                foreach ($users as $user) {
                    $this->fpdf->SetX(7);
                    $this->fpdf->Cell(14, 10, $user->id, 1, 0, 'C');
                    $this->fpdf->Cell(22, 10, $user->documento, 1, 0, 'C');
                    $this->fpdf->Cell(22, 10, $user->name, 1, 0, 'C');
                    $this->fpdf->Cell(22, 10, $user->apellido, 1, 0, 'C');
                    $this->fpdf->Cell(40, 10, $user->email, 1, 0, 'C');
                    $this->fpdf->Cell(20, 10, $user->telefono, 1, 0, 'C');
                    $this->fpdf->Cell(40, 10, $user->direccion, 1, 0, 'C');
                    $this->fpdf->Cell(18, 10, $user->Estado, 1, 1, 'C');
                }
            }
            $this->footer();
            $this->fpdf->Output();
            exit();
        } else {
            $users = $users->paginate();
            $this->fpdf->AddPage();
            $this->fpdf->SetFont('Arial', 'B', 20);
            $this->fpdf->Cell(0, 15, 'Reporte de Administradores', 0, 1, 'C');

            // Separador
            $this->fpdf->SetDrawColor(51, 122, 183);
            $this->fpdf->SetLineWidth(0.5);
            $this->fpdf->Line(10, 48, 200, 48);
            $this->fpdf->Ln(10);
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->SetY(55);
            $this->fpdf->SetX(7);
            $this->fpdf->Cell(14, 10, 'Codigo', 1, 0, 'C');
            $this->fpdf->Cell(22, 10, 'Documento', 1, 0, 'C');
            $this->fpdf->Cell(22, 10, 'Nombre', 1, 0, 'C');
            $this->fpdf->Cell(22, 10, 'Apellido', 1, 0, 'C');
            $this->fpdf->Cell(40, 10, 'Email', 1, 0, 'C');
            $this->fpdf->Cell(20, 10, 'Telefono', 1, 0, 'C');
            $this->fpdf->Cell(40, 10, 'Direccion', 1, 0, 'C');
            $this->fpdf->Cell(18, 10, 'Estado', 1, 1, 'C');
            if ($users->isEmpty()) {
                $this->fpdf->Cell(20, 20, 'No se encuentran resultados', 1, 1, 'C');
            } else {
                foreach ($users as $user) {
                    $this->fpdf->SetX(7);
                    $this->fpdf->Cell(14, 10, $user->id, 1, 0, 'C');
                    $this->fpdf->Cell(22, 10, $user->documento, 1, 0, 'C');
                    $this->fpdf->Cell(22, 10, $user->name, 1, 0, 'C');
                    $this->fpdf->Cell(22, 10, $user->apellido, 1, 0, 'C');
                    $this->fpdf->Cell(40, 10, $user->email, 1, 0, 'C');
                    $this->fpdf->Cell(20, 10, $user->telefono, 1, 0, 'C');
                    $this->fpdf->Cell(40, 10, $user->direccion, 1, 0, 'C');
                    $this->fpdf->Cell(18, 10, $user->Estado, 1, 1, 'C');
                }
            }
            $this->footer();
            $this->fpdf->Output();
            exit();
        }
    }





    ///PDF DE PRODUCTOS
    public function indexPRO(Request $request, Producto $producto)
    {
        if (request()->input('id') || request()->input('Nombre') || request()->input('Precio') || request()->input('stock') || request()->input('Estado') || request()->input('categoria_id')) {            // Si se están aplicando filtros, realizar la búsqueda
            $producto = Producto::query();
            if (request()->input('id')) {
                $producto->where('id', 'LIKE', '%' . request()->input('id') . '%');
            }
            if (request()->input('Nombre')) {
                $producto->where('Nombre', 'LIKE', '%' .  request()->input('Nombre') . '%');
            }
            if (request()->input('Precio')) {
                $producto->where('Precio', 'LIKE', '%' . request()->input('Precio') . '%');
            }
            if (request()->input('stock')) {
                $producto->where('stock', 'LIKE', '%' . request()->input('stock') . '%');
            }
            if (request()->input('Estado')) {
                $producto->where('Estado', 'LIKE', '%' . request()->input('Estado') . '%');
            }
            if (request()->input('categoria_id')) {
                $producto->where('categoria_id', request()->input('categoria_id') );
            }
            $producto = $producto->paginate();
            $this->fpdf->AddPage();
            $this->fpdf->SetFont('Arial', 'B', 20);
            $this->fpdf->Cell(0, 15, 'Reporte De Productos', 0, 1, 'C');

            // Separador
            $this->fpdf->SetDrawColor(51, 122, 183);
            $this->fpdf->SetLineWidth(0.5);
            $this->fpdf->Line(10, 48, 200, 48);
            $this->fpdf->Ln(10);
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->SetY(55);
            $this->fpdf->SetX(7);
            $this->fpdf->Cell(14, 10, 'Codigo', 1, 0, 'C');
            $this->fpdf->Cell(22, 10, 'Imagen', 1, 0, 'C');
            $this->fpdf->Cell(22, 10, 'Nombre', 1, 0, 'C');
            $this->fpdf->Cell(22, 10, 'Descripcion', 1, 0, 'C');
            $this->fpdf->Cell(40, 10, 'Precio', 1, 0, 'C');
            $this->fpdf->Cell(20, 10, 'Stock', 1, 0, 'C');
            $this->fpdf->Cell(40, 10, 'Categoria', 1, 0, 'C');
            $this->fpdf->Cell(15,10,'Registro',1,0,'C');
            $this->fpdf->Cell(18, 10, 'Estado', 1, 1, 'C');
            if ($producto->isEmpty()) {
                $this->fpdf->Cell(20, 20, 'No se encuentran resultados', 1, 1, 'C');
            } else {
                foreach ($producto as $producto) {
                    $this->fpdf->SetX(7);
                    $this->fpdf->Cell(14, 10, $producto->id, 1, 0, 'C');
                    $this->fpdf->Cell(22, 10, $producto->imagen, 1, 0, 'C');
                    $this->fpdf->Cell(22, 10, $producto->Nombre, 1, 0, 'C');
                    $this->fpdf->Cell(22, 10, $producto->descripcion, 1, 0, 'C');
                    $this->fpdf->Cell(40, 10, $producto->Precio, 1, 0, 'C');
                    $this->fpdf->Cell(20, 10, $producto->stock, 1, 0, 'C');
                    $this->fpdf->Cell(40, 10, $producto->categoria_id, 1, 0, 'C');
                    $this->fpdf->Cell(15,10,$producto->updated_at,1,0,'C');
                    $this->fpdf->Cell(18, 10, $producto->Estado, 1, 1, 'C');
                }
            }
            $this->footer();
            $this->fpdf->Output();
            exit();
        } else {
            $producto = $producto->paginate();
            $this->fpdf->AddPage();
            $this->fpdf->SetFont('Arial', 'B', 20);
            $this->fpdf->Cell(0, 15, 'Reporte De Productos', 0, 1, 'C');

            // Separador
            $this->fpdf->SetDrawColor(51, 122, 183);
            $this->fpdf->SetLineWidth(0.5);
            $this->fpdf->Line(10, 48, 200, 48);
            $this->fpdf->Ln(10);
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->SetY(55);
            $this->fpdf->SetX(7);
            $this->fpdf->Cell(14, 10, 'Codigo', 1, 0, 'C');
            $this->fpdf->Cell(22, 10, 'Imagen', 1, 0, 'C');
            $this->fpdf->Cell(22, 10, 'Nombre', 1, 0, 'C');
            $this->fpdf->Cell(22, 10, 'Decripcion', 1, 0, 'C');
            $this->fpdf->Cell(40, 10, 'Precio', 1, 0, 'C');
            $this->fpdf->Cell(20, 10, 'Stock', 1, 0, 'C');
            $this->fpdf->Cell(40, 10, 'Categoria', 1, 0, 'C');
            $this->fpdf->Cell(40, 10, 'Registro', 1, 0, 'C');
            $this->fpdf->Cell(18, 10, 'Estado', 1, 1, 'C');
            if ($producto->isEmpty()) {
                $this->fpdf->Cell(20, 20, 'No se encuentran resultados', 1, 1, 'C');
            } else {
                foreach ($producto as $producto) {
                    $this->fpdf->SetX(7);
                    $this->fpdf->Cell(14, 10, $producto->id, 1, 0, 'C');
                    $this->fpdf->Cell(22, 10, $producto->imagen, 1, 0, 'C');
                    $this->fpdf->Cell(22, 10, $producto->Nombre, 1, 0, 'C');
                    $this->fpdf->Cell(22, 10, $producto->descripcion, 1, 0, 'C');
                    $this->fpdf->Cell(40, 10, $producto->Precio, 1, 0, 'C');
                    $this->fpdf->Cell(20, 10, $producto->stock, 1, 0, 'C');
                    $this->fpdf->Cell(40, 10, $producto->categoria_id, 1, 0, 'C');
                    $this->fpdf->Cell(15,10,$producto->updated_at,1,0,'C');
                    $this->fpdf->Cell(18, 10, $producto->Estado, 1, 1, 'C');
                }
            }
            $this->footer();
            $this->fpdf->Output();
            exit();
        }
    }






    //PDF DEL CLIENTE
    public function indexCL(Request $request, Cliente $cliente)
    {

        if (request()->input('id') || request()->input('documento') || request()->input('Nombre') || request()->input('Apellido') || request()->input('Estado') || request()->input('categoria_id')) {            // Si se están aplicando filtros, realizar la búsqueda
            $cliente = Cliente::query();
            if (request()->input('id')) {
                $cliente->where('id', 'LIKE', '%' . request()->input('id') . '%');
            }
            if (request()->input('documento')) {
                $cliente->where('documento', 'LIKE', '%' .  request()->input('documento') . '%');
            }
            if (request()->input('Nombre')) {
                $cliente->where('Nombre', 'LIKE', '%' . request()->input('Nombre') . '%');
            }
            if (request()->input('Apellido')) {
                $cliente->where('Apellido', 'LIKE', '%' . request()->input('Apellido') . '%');
            }
            if (request()->input('Email')) {
                $cliente->where('Email', 'LIKE', '%' . request()->input('Email') . '%');
            }
            if (request()->input('telefono')) {
                $cliente->where('Telefono', 'LIKE', '%' . request()->input('telefono') . '%');
            }
            if (request()->input('Estado')) {
                $cliente->where('Estado', 'LIKE', '%' . request()->input('Estado') . '%');
            }
            $cliente = $cliente->paginate();
            $this->fpdf->AddPage();
            $this->fpdf->SetFont('Arial', 'B', 20);
            $this->fpdf->Cell(0, 15, 'Reporte De Clientes', 0, 1, 'C');

            // Separador
            $this->fpdf->SetDrawColor(51, 122, 183);
            $this->fpdf->SetLineWidth(0.5);
            $this->fpdf->Line(10, 48, 200, 48);
            $this->fpdf->Ln(10);
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->SetY(55);
            $this->fpdf->SetX(7);
            $this->fpdf->Cell(14, 10, 'Codigo', 1, 0, 'C');
            $this->fpdf->Cell(22, 10, 'Documento', 1, 0, 'C');
            $this->fpdf->Cell(22, 10, 'Nombre', 1, 0, 'C');
            $this->fpdf->Cell(22, 10, 'Apellido', 1, 0, 'C');
            $this->fpdf->Cell(40, 10, 'Edad', 1, 0, 'C');
            $this->fpdf->Cell(20, 10, 'Direccion', 1, 0, 'C');
            $this->fpdf->Cell(40, 10, 'Telefono', 1, 0, 'C');
            $this->fpdf->Cell(15,10,'Email',1,0,'C');
            $this->fpdf->Cell(15,10,'updated_at',1,0,'C');
            $this->fpdf->Cell(18, 10, 'Estado', 1, 1, 'C');
            if ($cliente->isEmpty()) {
                $this->fpdf->Cell(20, 20, 'No se encuentran resultados', 1, 1, 'C');
            } else {
                foreach ($cliente as $cliente) {
                    $this->fpdf->SetX(7);
                    $this->fpdf->Cell(14, 10, $cliente->id, 1, 0, 'C');
                    $this->fpdf->Cell(22, 10, $cliente->documento, 1, 0, 'C');
                    $this->fpdf->Cell(22, 10, $cliente->Nombre, 1, 0, 'C');
                    $this->fpdf->Cell(22, 10, $cliente->Apellido, 1, 0, 'C');
                    $this->fpdf->Cell(40, 10, $cliente-> Edad, 1, 0, 'C');
                    $this->fpdf->Cell(20, 10, $cliente->Direccion, 1, 0, 'C');
                    $this->fpdf->Cell(40, 10, $cliente->Telefono, 1, 0, 'C');
                    $this->fpdf->Cell(15,10,$cliente->Email,1,0,'C');
                    $this->fpdf->Cell(15,10,$cliente->updated_at,1,0,'C');
                    $this->fpdf->Cell(18, 10, $cliente->Estado, 1, 1, 'C');
                }
            }
            $this->footer();
            $this->fpdf->Output();
            exit();
        } else {
            $cliente = $cliente->paginate();
            $this->fpdf->AddPage();
            $this->fpdf->SetFont('Arial', 'B', 20);
            $this->fpdf->Cell(0, 15, 'Reporte De Clientes', 0, 1, 'C');

            // Separador
            $this->fpdf->SetDrawColor(51, 122, 183);
            $this->fpdf->SetLineWidth(0.5);
            $this->fpdf->Line(10, 48, 200, 48);
            $this->fpdf->Ln(10);
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->SetY(55);
            $this->fpdf->SetX(7);
            $this->fpdf->Cell(14, 10, 'Codigo', 1, 0, 'C');
            $this->fpdf->Cell(22, 10, 'Documento', 1, 0, 'C');
            $this->fpdf->Cell(22, 10, 'Nombre', 1, 0, 'C');
            $this->fpdf->Cell(22, 10, 'Apellido', 1, 0, 'C');
            $this->fpdf->Cell(40, 10, 'Edad', 1, 0, 'C');
            $this->fpdf->Cell(20, 10, 'Direccion', 1, 0, 'C');
            $this->fpdf->Cell(40, 10, 'Telefono', 1, 0, 'C');
            $this->fpdf->Cell(40, 10, 'Email', 1, 0, 'C');
            $this->fpdf->Cell(40, 10, 'Registros', 1, 0, 'C');
            $this->fpdf->Cell(18, 10, 'Estado', 1, 1, 'C');
            if ($cliente->isEmpty()) {
                $this->fpdf->Cell(20, 20, 'No se encuentran resultados', 1, 1, 'C');
            } else {
                foreach ($cliente as $cliente) {
                    $this->fpdf->SetX(7);
                    $this->fpdf->Cell(14, 10, $cliente->id, 1, 0, 'C');
                    $this->fpdf->Cell(22, 10, $cliente->documento, 1, 0, 'C');
                    $this->fpdf->Cell(22, 10, $cliente->Nombre, 1, 0, 'C');
                    $this->fpdf->Cell(22, 10, $cliente->Apellido, 1, 0, 'C');
                    $this->fpdf->Cell(40, 10, $cliente-> Edad, 1, 0, 'C');
                    $this->fpdf->Cell(20, 10, $cliente->Direccion, 1, 0, 'C');
                    $this->fpdf->Cell(40, 10, $cliente->Telefono, 1, 0, 'C');
                    $this->fpdf->Cell(15,10,$cliente->Email,1,0,'C');
                    $this->fpdf->Cell(15,10,$cliente->updated_at,1,0,'C');
                    $this->fpdf->Cell(18, 10, $cliente->Estado, 1, 1, 'C');
                }
            }
            $this->footer();
            $this->fpdf->Output();
            exit();
        }
    }





    //REPORTE DE TABLA CATEGORIAS
    public function indexCA(Request $request, Categoria $categoria)
    {

        if (request()->input('id') || request()->input('Nombre') || request()->input('Estado')) {            // Si se están aplicando filtros, realizar la búsqueda
            $cliente = Cliente::query();
            if (request()->input('id')) {
                $categoria->where('id', 'LIKE', '%' . request()->input('id') . '%');
            }
            if (request()->input('Nombre')) {
                $categoria->where('Nombre', 'LIKE', '%' .  request()->input('Nombre') . '%');
            }
            if (request()->input('Estado')) {
                $categoria->where('Estado', 'LIKE', '%' . request()->input('Estado') . '%');
            }
            $categoria = $categoria->paginate();
            $this->fpdf->AddPage();
            $this->fpdf->SetFont('Arial', 'B', 20);
            $this->fpdf->Cell(0, 15, 'Reporte De Categorias', 0, 1, 'C');

            // Separador
            $this->fpdf->SetDrawColor(51, 122, 183);
            $this->fpdf->SetLineWidth(0.5);
            $this->fpdf->Line(10, 48, 200, 48);
            $this->fpdf->Ln(10);
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->SetY(55);
            $this->fpdf->SetX(7);
            $this->fpdf->Cell(14, 10, 'Codigo', 1, 0, 'C');
            $this->fpdf->Cell(22, 10, 'Nombre', 1, 0, 'C');
            $this->fpdf->Cell(22, 10, 'Descripcion', 1, 0, 'C');            
            $this->fpdf->Cell(40, 10, 'Productos', 1, 0, 'C');
            $this->fpdf->Cell(22, 10, 'Registro', 1, 0, 'C');
            $this->fpdf->Cell(20, 10, 'Estado', 1, 1, 'C');
            
            if ($categoria->isEmpty()) {
                $this->fpdf->Cell(20, 20, 'No se encuentran resultados', 1, 1, 'C');
            } else {
                foreach ($categoria as $categoria) {
                    $this->fpdf->SetX(7);
                    $this->fpdf->Cell(14, 10, $categoria->id, 1, 0, 'C');
                    $this->fpdf->Cell(22, 10, $categoria->Nombre, 1, 0, 'C');
                    $this->fpdf->Cell(22, 10, $categoria->Descripcion, 1, 0, 'C');
                    $this->fpdf->Cell(22, 10, $categoria->updated_at, 1, 0, 'C');
                    $this->fpdf->Cell(22, 10, 'asd', 1, 0, 'C');
                    $this->fpdf->Cell(40, 10, $categoria->Estado, 1, 1, 'C');
                   
                }
            }
            $this->footer();
            $this->fpdf->Output();
            exit();
        } else {
            $categoria = $categoria->paginate();
            $this->fpdf->AddPage();
            $this->fpdf->SetFont('Arial', 'B', 20);
            $this->fpdf->Cell(0, 15, 'Reporte De Categorias', 0, 1, 'C');

            // Separador
            $this->fpdf->SetDrawColor(51, 122, 183);
            $this->fpdf->SetLineWidth(0.5);
            $this->fpdf->Line(10, 48, 200, 48);
            $this->fpdf->Ln(10);
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->SetY(55);
            $this->fpdf->SetX(7);
            $this->fpdf->Cell(14, 10, 'Codigo', 1, 0, 'C');
            $this->fpdf->Cell(22, 10, 'Nombre', 1, 0, 'C');
            $this->fpdf->Cell(22, 10, 'Descripcion', 1, 0, 'C');            
            $this->fpdf->Cell(40, 10, 'Productos', 1, 0, 'C');
            $this->fpdf->Cell(22, 10, 'Registro', 1, 0, 'C');
            $this->fpdf->Cell(20, 10, 'Estado', 1, 1, 'C');
            
            if ($categoria->isEmpty()) {
                $this->fpdf->Cell(20, 20, 'No se encuentran resultados', 1, 1, 'C');
            } else {
                foreach ($categoria as $categoria) {
                    $this->fpdf->SetX(7);
                    $this->fpdf->Cell(14, 10, $categoria->id, 1, 0, 'C');
                    $this->fpdf->Cell(22, 10, $categoria->Nombre, 1, 0, 'C');
                    $this->fpdf->Cell(22, 10, $categoria->Descripcion, 1, 0, 'C');
                    $this->fpdf->Cell(22, 10, $categoria->updated_at, 1, 0, 'C');
                    $this->fpdf->Cell(22, 10, 'asd', 1, 0, 'C');
                    $this->fpdf->Cell(40, 10, $categoria->Estado, 1, 1, 'C');
                   
                }
            }
            $this->footer();
            $this->fpdf->Output();
            exit();
        }
    }


    public function indexDESE(Request $request, Deselist $deseos)
    {

        if (request()->input('codi') || request()->input('cliente') || request()->input('pro_id')) {            // Si se están aplicando filtros, realizar la búsqueda
            $deseos = Deselist::query();
            if (request()->input('codi')) {
                $deseos->where('id', 'LIKE', '%' . request()->input('codi') . '%');
            }
            if (request()->input('cliente')) {
                $deseos->where('cliente_id', 'LIKE', '%' .  request()->input('cliente') . '%');
            }
            if (request()->input('pro_id')) {
                $deseos->where('producto_id', 'LIKE', '%' . request()->input('pro_id') . '%');
            }
            $deseos = $deseos->paginate();
            $this->fpdf->AddPage();
            $this->fpdf->SetFont('Arial', 'B', 20);
            $this->fpdf->Cell(0, 15, 'Reporte De La Lista De Deseos', 0, 1, 'C');

            // Separador
            $this->fpdf->SetDrawColor(51, 122, 183);
            $this->fpdf->SetLineWidth(0.5);
            $this->fpdf->Line(10, 48, 200, 48);
            $this->fpdf->Ln(10);
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->SetY(55);
            $this->fpdf->SetX(7);
            $this->fpdf->Cell(14, 10, 'Codigo', 1, 0, 'C');
            $this->fpdf->Cell(22, 10, 'Codigo Cliente', 1, 0, 'C');
            $this->fpdf->Cell(22, 10, 'Producto', 1, 0, 'C');            
            $this->fpdf->Cell(40, 10, 'Registro', 1, 0, 'C');            
            if ($deseos->isEmpty()) {
                $this->fpdf->Cell(20, 20, 'No se encuentran resultados', 1, 1, 'C');
            } else {
                foreach ($deseos as $deseos) {
                    $this->fpdf->SetX(7);
                    $this->fpdf->Cell(14, 10, $deseos->id, 1, 0, 'C');
                    $this->fpdf->Cell(22, 10, $deseos->cliente_id, 1, 0, 'C');
                    $this->fpdf->Cell(22, 10, $deseos->producto_id, 1, 0, 'C');
                    $this->fpdf->Cell(22, 10, $deseos->updated_at, 1, 1, 'C');
                  
                   
                }
            }
            $this->footer();
            $this->fpdf->Output();
            exit();
        } else {
            $deseos = $deseos->paginate();
            $this->fpdf->AddPage();
            $this->fpdf->SetFont('Arial', 'B', 20);
            $this->fpdf->Cell(0, 15, 'Reporte De La Lista De Deseos', 0, 1, 'C');

            // Separador
            $this->fpdf->SetDrawColor(51, 122, 183);
            $this->fpdf->SetLineWidth(0.5);
            $this->fpdf->Line(10, 48, 200, 48);
            $this->fpdf->Ln(10);
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->SetY(55);
            $this->fpdf->SetX(7);
            $this->fpdf->Cell(14, 10, 'Codigo', 1, 0, 'C');
            $this->fpdf->Cell(22, 10, 'Codigo Cliente', 1, 0, 'C');
            $this->fpdf->Cell(22, 10, 'Producto', 1, 0, 'C');          
            $this->fpdf->Cell(22, 10, 'Registro', 1, 1, 'C');
           
            
            if ($deseos->isEmpty()) {
                $this->fpdf->Cell(20, 20, 'No se encuentran resultados', 1, 1, 'C');
            } else {
                foreach ($deseos as $deseos) {
                    $this->fpdf->SetX(7);
                    $this->fpdf->Cell(14, 10, $deseos->id, 1, 0, 'C');
                    $this->fpdf->Cell(22, 10, $deseos->cliente_id, 1, 0, 'C');
                    $this->fpdf->Cell(22, 10, $deseos->producto_id, 1, 0, 'C');
                    $this->fpdf->Cell(22, 10, $deseos->updated_at, 1, 1, 'C');
                   
                   
                }
            }
            $this->footer();
            $this->fpdf->Output();
            exit();
        }
    }


 public function indexCALI(Request $request, Calificacion $calificacion)
    {

        if (request()->input('codi') || request()->input('cliente') || request()->input('pro_id')) {            // Si se están aplicando filtros, realizar la búsqueda
            $calificacion = Calificacion::query();
            if (request()->input('codi')) {
                $calificacion->where('id', 'LIKE', '%' . request()->input('codi') . '%');
            }
            if (request()->input('cliente')) {
                $calificacion->where('cliente_id', 'LIKE', '%' .  request()->input('cliente') . '%');
            }
            if (request()->input('pro_id')) {
                $calificacion->where('producto_id', 'LIKE', '%' . request()->input('pro_id') . '%');
            }
            $calificacion = $calificacion->paginate();
            $this->fpdf->AddPage();
            $this->fpdf->SetFont('Arial', 'B', 20);
            $this->fpdf->Cell(0, 15, 'Reporte De Las Calificaciones Del Cliente', 0, 1, 'C');

            // Separador
            $this->fpdf->SetDrawColor(51, 122, 183);
            $this->fpdf->SetLineWidth(0.5);
            $this->fpdf->Line(10, 48, 200, 48);
            $this->fpdf->Ln(10);
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->SetY(55);
            $this->fpdf->SetX(7);
            $this->fpdf->Cell(14, 10, 'Codigo', 1, 0, 'C');
            $this->fpdf->Cell(22, 10, 'Producto', 1, 0, 'C'); 
            $this->fpdf->Cell(22, 10, 'Codigo Cliente', 1, 0, 'C');
            $this->fpdf->Cell(22,10,'Estrellas',1,0,'C');
            $this->fpdf->Cell(40, 10, 'Registro', 1, 1, 'C');            
            if ($calificacion->isEmpty()) {
                $this->fpdf->Cell(20, 20, 'No se encuentran resultados', 1, 1, 'C');
            } else {
                foreach ($calificacion as $calificacion) {
                    $this->fpdf->SetX(7);
                    $this->fpdf->Cell(14, 10, $calificacion->id, 1, 0, 'C');
                     $this->fpdf->Cell(22, 10, $calificacion->producto_id, 1, 0, 'C');
                    $this->fpdf->Cell(22, 10, $calificacion->cliente_id, 1, 0, 'C');                   
                    $this->fpdf->Cell(22, 10, $calificacion->updated_at, 1, 1, 'C');         
                   
                }
            }
            $this->footer();
            $this->fpdf->Output();
            exit();
        } else {
            $calificacion = $calificacion->paginate();
            $this->fpdf->AddPage();
            $this->fpdf->SetFont('Arial', 'B', 20);
            $this->fpdf->Cell(0, 15, 'Reporte De Las Calificiones Del CLiente', 0, 1, 'C');

            // Separador
            $this->fpdf->SetDrawColor(51, 122, 183);
            $this->fpdf->SetLineWidth(0.5);
            $this->fpdf->Line(10, 48, 200, 48);
            $this->fpdf->Ln(10);
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->SetY(55);
            $this->fpdf->SetX(7);
            $this->fpdf->Cell(14, 10, 'Codigo', 1, 0, 'C');
             $this->fpdf->Cell(22, 10, 'Producto', 1, 0, 'C');
            $this->fpdf->Cell(22, 10, 'Codigo Cliente', 1, 0, 'C');           
            $this->fpdf->Cell(22,10,'Estrellas',1,0,'C');
            $this->fpdf->Cell(22, 10, 'Registro', 1, 1, 'C');
           
            
            if ($calificacion->isEmpty()) {
                $this->fpdf->Cell(20, 20, 'No se encuentran resultados', 1, 1, 'C');
            } else {
                foreach ($calificacion as $calificacion) {
                    $this->fpdf->SetX(7);
                    $this->fpdf->Cell(14, 10, $calificacion->id, 1, 0, 'C');
                    $this->fpdf->Cell(22, 10, $calificacion->producto_id, 1, 0, 'C');
                    $this->fpdf->Cell(22, 10, $calificacion->cliente_id, 1, 0, 'C');
                    $this->fpdf->Cell(22,10,$calificacion->estrellas,1,0,'C');
                    $this->fpdf->Cell(22, 10, $calificacion->updated_at, 1, 1, 'C');
                }
            }
            $this->footer();
            $this->fpdf->Output();
            exit();
        }
    }

    public function indexCOM(Request $request, Comentario $comentario)
    {
        if (request()->input('codi') || request()->input('cliente') || request()->input('pro_id')) {            // Si se están aplicando filtros, realizar la búsqueda
            $comentario = Comentario::query();
            if (request()->input('codi')) {
                $comentario->where('id', 'LIKE', '%' . request()->input('codi') . '%');
            }
            if (request()->input('cliente')) {
                $comentario->where('cliente_id', 'LIKE', '%' .  request()->input('cliente') . '%');
            }
            if (request()->input('pro_id')) {
                $comentario->where('producto_id', 'LIKE', '%' . request()->input('pro_id') . '%');
            }
            $comentario = $comentario->paginate();
            $this->fpdf->AddPage();
            $this->fpdf->SetFont('Arial', 'B', 20);
            $this->fpdf->Cell(0, 15, 'Reporte De Los Comentarios Del Cliente', 0, 1, 'C');
            // Separador
            $this->fpdf->SetDrawColor(51, 122, 183);
            $this->fpdf->SetLineWidth(0.5);
            $this->fpdf->Line(10, 48, 200, 48);
            $this->fpdf->Ln(10);
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->SetY(55);
            $this->fpdf->SetX(7);
            $this->fpdf->Cell(14, 10, 'Codigo', 1, 0, 'C');
            $this->fpdf->Cell(22, 10, 'Producto', 1, 0, 'C'); 
            $this->fpdf->Cell(22, 10, 'Codigo Cliente', 1, 0, 'C');
            $this->fpdf->Cell(22,10,'Comentario',1,0,'C');
            $this->fpdf->Cell(40, 10, 'Registro', 1, 1, 'C');            
            if ($comentario->isEmpty()) {
                $this->fpdf->Cell(20, 20, 'No se encuentran resultados', 1, 1, 'C');
            } else {
                foreach ($comentario as $comentario) {
                    $this->fpdf->SetX(7);
                    $this->fpdf->Cell(14, 10, $comentario->id, 1, 0, 'C');
                     $this->fpdf->Cell(22, 10, $comentario->producto_id, 1, 0, 'C');

                    $this->fpdf->Cell(22, 10, $comentario->cliente_id, 1, 0, 'C');                   
                    $this->fpdf->Cell(22,10,$comentario->comentario,1,0,'C');
                    $this->fpdf->Cell(22, 10, $comentario->updated_at, 1, 1, 'C');         
                }
            }
            $this->footer();
            $this->fpdf->Output();
            exit();
        } else {
            $comentario = $comentario->paginate();
            $this->fpdf->AddPage();
            $this->fpdf->SetFont('Arial', 'B', 20);
            $this->fpdf->Cell(0, 15, 'Reporte De Los Comentarios Del CLiente', 0, 1, 'C');
            // Separador
            $this->fpdf->SetDrawColor(51, 122, 183);
            $this->fpdf->SetLineWidth(0.5);
            $this->fpdf->Line(10, 48, 200, 48);
            $this->fpdf->Ln(10);
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->SetY(55);
            $this->fpdf->SetX(7);
            $this->fpdf->Cell(14, 10, 'Codigo', 1, 0, 'C');
             $this->fpdf->Cell(22, 10, 'Producto', 1, 0, 'C');
            $this->fpdf->Cell(22, 10, 'Codigo Cliente', 1, 0, 'C');           
            $this->fpdf->Cell(22,10,'Estrellas',1,0,'C');
            $this->fpdf->Cell(22, 10, 'Registro', 1, 1, 'C');
            if ($comentario->isEmpty()) {
                $this->fpdf->Cell(20, 20, 'No se encuentran resultados', 1, 1, 'C');
            } else {
                foreach ($comentario as $comentario) {
                    $this->fpdf->SetX(7);
                    $this->fpdf->Cell(14, 10, $comentario->id, 1, 0, 'C');
                    $this->fpdf->Cell(22, 10, $comentario->producto_id, 1, 0, 'C');
                    $this->fpdf->Cell(22, 10, $comentario->cliente_id, 1, 0, 'C');
                    $this->fpdf->Cell(22,10,$comentario->comentario,1,0,'C');
                    $this->fpdf->Cell(22, 10, $comentario->updated_at, 1, 1, 'C');
                }
            }
            $this->footer();
            $this->fpdf->Output();
            exit();
        }
    }
    
    public function indexCUP(Request $request, Cupone $cupon)
    {
        if (request()->input('id')  ||  request()->input('cupon') || request()->input('fec_ini') || request()->input('fec_fin') || request()->input('categoria_id') || request()->input('Estado')) {
            // Si se están aplicando filtros, realizar la búsqueda
            $cupon = Cupone::query();
            if (request()->input('id')) {
                $cupon->where('id', 'LIKE', '%' . request()->input('codi') . '%');
            }
            if (request()->input('cupon')) {
                $cupon->where('cupon', 'LIKE', '%' .  request()->input('cupon') . '%');
            }
            if (request()->input('fec_ini')) {
                $cupon->where('fec_ini', 'LIKE', '%' . request()->input('fec_ini') . '%');
            }
            if(request()->input('fec_fin')){
                $cupon->where('fec_fin','LIKE','%'.request()->input('fec_fin').'%');
            }
            if (request()->input('categoria_id')) {
                $cupon->Where('categorias','%'.request()->input('categoria_id').'%');
            }
            $cupon = $cupon->paginate();
            $this->fpdf->AddPage();
            $this->fpdf->SetFont('Arial', 'B', 20);
            $this->fpdf->Cell(0, 15, 'Reporte De Los Cupones', 0, 1, 'C');
            // Separador
            $this->fpdf->SetDrawColor(51, 122, 183);
            $this->fpdf->SetLineWidth(0.5);
            $this->fpdf->Line(10, 48, 200, 48);
            $this->fpdf->Ln(10);
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->SetY(55);
            $this->fpdf->SetX(7);
            $this->fpdf->Cell(14, 10, 'Codigo', 1, 0, 'C');
            $this->fpdf->Cell(22, 10, 'Cupon', 1, 0, 'C'); 
            $this->fpdf->Cell(22, 10, '% Descuento', 1, 0, 'C');
            $this->fpdf->Cell(22,10,'Fecha Inicio',1,0,'C');
            $this->fpdf->Cell(22,10,'Fecha Fin',1,0,'C');
            $this->fpdf->Cell(22, 10, 'Multiples Usos', 1, 0, 'C');
            $this->fpdf->Cell(22,10,'Cantidad',1,0,'C');
            $this->fpdf->Cell(22,10,'Categorias',1,0,'C');
            $this->fpdf->Cell(22,10,'Estado',1,0,'C');
            $this->fpdf->Cell(40, 10, 'Registro', 1, 1, 'C');            
            if ($cupon->isEmpty()) {
                $this->fpdf->Cell(20, 20, 'No se encuentran resultados', 1, 1, 'C');
            } else {
                foreach ($cupon as $cupon) {
                    $this->fpdf->SetX(7);
                    $this->fpdf->Cell(14, 10, $cupon->id, 1, 0, 'C');
                     $this->fpdf->Cell(22, 10, $cupon->cupon, 1, 0, 'C');
                     $this->fpdf->Cell(14, 10, $cupon->descuento, 1, 0, 'C');
                     $this->fpdf->Cell(22, 10, $cupon->fec_ini, 1, 0, 'C');
                    $this->fpdf->Cell(22, 10, $cupon->fec_fin, 1, 0, 'C');                   
                    $this->fpdf->Cell(22,10,$cupon->mul_usos,1,0,'C');
                    $this->fpdf->Cell(22, 10, $cupon->cantidad, 1, 0, 'C');
                    $this->fpdf->Cell(22, 10, $cupon->categorias, 1, 0, 'C');                   
                    $this->fpdf->Cell(22,10,$cupon->estado,1,0,'C');
                    $this->fpdf->Cell(22, 10, $cupon->updated_at, 1, 1, 'C');         
                }
            }
            $this->footer();
            $this->fpdf->Output();
            exit();
        } else {
            $cupon = $cupon->paginate();
            $this->fpdf->AddPage();
            $this->fpdf->SetFont('Arial', 'B', 20);
            $this->fpdf->Cell(0, 15, 'Reporte De Los Comentarios Del CLiente', 0, 1, 'C');
            // Separador
            $this->fpdf->SetDrawColor(51, 122, 183);
            $this->fpdf->SetLineWidth(0.5);
            $this->fpdf->Line(10, 48, 200, 48);
            $this->fpdf->Ln(10);
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->SetY(55);
            $this->fpdf->SetX(7);
            $this->fpdf->Cell(14, 10, 'Codigo', 1, 0, 'C');
            $this->fpdf->Cell(22, 10, 'Cupon', 1, 0, 'C'); 
            $this->fpdf->Cell(22, 10, '% Descuento', 1, 0, 'C');
            $this->fpdf->Cell(22,10,'Fecha Inicio',1,0,'C');
            $this->fpdf->Cell(22,10,'Fecha Fin',1,0,'C');
            $this->fpdf->Cell(22, 10, 'Multiples Usos', 1, 0, 'C');
            $this->fpdf->Cell(22,10,'Cantidad',1,0,'C');
            $this->fpdf->Cell(22,10,'Categorias',1,0,'C');
            $this->fpdf->Cell(22,10,'Estado',1,0,'C');
            $this->fpdf->Cell(40, 10, 'Registro', 1, 1, 'C');   
            if ($cupon->isEmpty()) {
                $this->fpdf->Cell(20, 20, 'No se encuentran resultados', 1, 1, 'C');
            } else {
                foreach ($cupon as $cupon) {
                    $this->fpdf->SetX(7);
                    $this->fpdf->Cell(14, 10, $cupon->id, 1, 0, 'C');
                     $this->fpdf->Cell(22, 10, $cupon->cupon, 1, 0, 'C');
                     $this->fpdf->Cell(14, 10, $cupon->descuento, 1, 0, 'C');
                     $this->fpdf->Cell(22, 10, $cupon->fec_ini, 1, 0, 'C');
                    $this->fpdf->Cell(22, 10, $cupon->fec_fin, 1, 0, 'C');                   
                    $this->fpdf->Cell(22,10,$cupon->mul_usos,1,0,'C');
                    $this->fpdf->Cell(22, 10, $cupon->cantidad, 1, 0, 'C');
                    $this->fpdf->Cell(22, 10, $cupon->categorias, 1, 0, 'C');                   
                    $this->fpdf->Cell(22,10,$cupon->estado,1,0,'C');
                    $this->fpdf->Cell(22, 10, $cupon->updated_at, 1, 1, 'C');
                }
            }
            $this->footer();
            $this->fpdf->Output();
            exit();
        }
    }


    public function indexPEDI(Request $request, Pedido $pedidos)
    {
        if (request()->input('id')  ||  request()->input('codi') || request()->input('Estado')) {
            // Si se están aplicando filtros, realizar la búsqueda
            $pedidos = Pedido::query();
            if (request()->input('id')){
                $pedidos->where('id', 'LIKE', '%' . request()->input('id') . '%');
            }
            if (request()->input('codi')) {
                $pedidos->where('cliente_id', 'LIKE', '%' .  request()->input('codi') . '%');
            }
            if (request()->input('Estado')) {
                $pedidos->where('Estado', 'LIKE', '%' . request()->input('Estado') . '%');
            }
            $pedidos = $pedidos->paginate();
            $this->fpdf->AddPage();
            $this->fpdf->SetFont('Arial', 'B', 20);
            $this->fpdf->Cell(0, 15, 'Reporte De Los Pedidos', 0, 1, 'C');
            // Separador
            $this->fpdf->SetDrawColor(51, 122, 183);
            $this->fpdf->SetLineWidth(0.5);
            $this->fpdf->Line(10, 48, 200, 48);
            $this->fpdf->Ln(10);
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->SetY(55);
            $this->fpdf->SetX(7);
            $this->fpdf->Cell(14, 10, 'Codigo', 1, 0, 'C');
            $this->fpdf->Cell(22, 10, 'Cod Cliente', 1, 0, 'C'); 
            $this->fpdf->Cell(22, 10, '# Productos', 1, 0, 'C');
            $this->fpdf->Cell(22,10,'Estado',1,0,'C');
            $this->fpdf->Cell(22,10,'Registro',1,1,'C');             
            if ($pedidos->isEmpty()) {
                $this->fpdf->Cell(20, 20, 'No se encuentran resultados', 1, 1, 'C');
            } else {
                foreach ($pedidos as $pedidos) {
                    $this->fpdf->SetX(7);
                    $this->fpdf->Cell(14, 10, $pedidos->id, 1, 0, 'C');
                     $this->fpdf->Cell(22, 10, $pedidos->cliente_id, 1, 0, 'C');
                     $this->fpdf->Cell(14, 10, $pedidos->cantidad_productos, 1, 0, 'C');
                     $this->fpdf->Cell(22, 10, $pedidos->Estado, 1, 0, 'C');
                    $this->fpdf->Cell(22, 10, $pedidos->updated_at, 1, 1, 'C');        
                }
            }
            $this->footer();
            $this->fpdf->Output();
            exit();
        } else {
            $pedidos = $pedidos->paginate();
            $this->fpdf->AddPage();
            $this->fpdf->SetFont('Arial', 'B', 20);
            $this->fpdf->Cell(0, 15, 'Reporte De Los Pedidos', 0, 1, 'C');
            // Separador
            $this->fpdf->SetDrawColor(51, 122, 183);
            $this->fpdf->SetLineWidth(0.5);
            $this->fpdf->Line(10, 48, 200, 48);
            $this->fpdf->Ln(10);
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->SetY(55);
            $this->fpdf->SetX(7);
            $this->fpdf->Cell(14, 10, 'Codigo', 1, 0, 'C');
            $this->fpdf->Cell(22, 10, 'Cod Cliente', 1, 0, 'C'); 
            $this->fpdf->Cell(22, 10, '# Productos', 1, 0, 'C');
            $this->fpdf->Cell(22,10,'Estado',1,0,'C');
            $this->fpdf->Cell(22,10,'Registro',1,1,'C'); 
            if ($pedidos->isEmpty()) {
                $this->fpdf->Cell(20, 20, 'No se encuentran resultados', 1, 1, 'C');
            } else {
                foreach ($pedidos as $pedidos) {
                    $this->fpdf->SetX(7);
                    $this->fpdf->Cell(14, 10, $pedidos->id, 1, 0, 'C');
                     $this->fpdf->Cell(22, 10, $pedidos->cliente_id, 1, 0, 'C');
                     $this->fpdf->Cell(14, 10, $pedidos->cantidad_productos, 1, 0, 'C');
                     $this->fpdf->Cell(22, 10, $pedidos->Estado, 1, 0, 'C');
                    $this->fpdf->Cell(22, 10, $pedidos->updated_at, 1, 1, 'C');        
                }
            }
            $this->footer();
            $this->fpdf->Output();
            exit();
        }
    }


    public function indexDETPE(Request $request,DetallePedido $pedidos)
    {
        if (request()->input('id')  ||  request()->input('codi') || request()->input('Estado')) {
            // Si se están aplicando filtros, realizar la búsqueda
            $pedidos = DetallePedido::query();
            if (request()->input('id')){
                $pedidos->where('id', 'LIKE', '%' . request()->input('id') . '%');
            }
            if (request()->input('codi')) {
                $pedidos->where('cliente_id', 'LIKE', '%' .  request()->input('codi') . '%');
            }
            if (request()->input('Estado')) {
                $pedidos->where('Estado', 'LIKE', '%' . request()->input('Estado') . '%');
            }
            $pedidos = $pedidos->paginate();
            $this->fpdf->AddPage();
            $this->fpdf->SetFont('Arial', 'B', 20);
            $this->fpdf->Cell(0, 15, 'Reporte De Los Productos Del Pedido', 0, 1, 'C');
            // Separador
            $this->fpdf->SetDrawColor(51, 122, 183);
            $this->fpdf->SetLineWidth(0.5);
            $this->fpdf->Line(10, 48, 200, 48);
            $this->fpdf->Ln(10);
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->SetY(55);
            $this->fpdf->SetX(7);
            $this->fpdf->Cell(14, 10, 'Codigo Pedido ', 1, 0, 'C');
            $this->fpdf->Cell(22, 10, 'Producto', 1, 0, 'C'); 
            $this->fpdf->Cell(22, 10, 'Cantidad', 1, 0, 'C');
            $this->fpdf->Cell(22,10,'Estado',1,0,'C');
            $this->fpdf->Cell(22,10,'Registro',1,1,'C');             
            if ($pedidos->isEmpty()) {
                $this->fpdf->Cell(20, 20, 'No se encuentran resultados', 1, 1, 'C');
            } else {
                foreach ($pedidos as $pedidos) {
                    $this->fpdf->SetX(7);
                    $this->fpdf->Cell(14, 10, $pedidos->pedido_id, 1, 0, 'C');
                     $this->fpdf->Cell(22, 10, $pedidos->producto_id, 1, 0, 'C');
                     $this->fpdf->Cell(14, 10, $pedidos->Cantidad, 1, 0, 'C');
                     $this->fpdf->Cell(22, 10, $pedidos->Estado, 1, 0, 'C');
                    $this->fpdf->Cell(22, 10, $pedidos->updated_at, 1, 1, 'C');        
                }
            }
            $this->footer();
            $this->fpdf->Output();
            exit();
        } else {
            $pedidos = $pedidos->paginate();
            $this->fpdf->AddPage();
            $this->fpdf->SetFont('Arial', 'B', 20);
            $this->fpdf->Cell(0, 15, 'Reporte De Los Productos Del Pedido', 0, 1, 'C');
            // Separador
            $this->fpdf->SetDrawColor(51, 122, 183);
            $this->fpdf->SetLineWidth(0.5);
            $this->fpdf->Line(10, 48, 200, 48);
            $this->fpdf->Ln(10);
            $this->fpdf->SetFont('Arial', 'B', 10);
            $this->fpdf->SetY(55);
            $this->fpdf->SetX(7);
            $this->fpdf->Cell(14, 10, 'Codigo Pedido', 1, 0, 'C');
            $this->fpdf->Cell(22, 10, 'Producto', 1, 0, 'C'); 
            $this->fpdf->Cell(22, 10, 'Cantidad', 1, 0, 'C');
            $this->fpdf->Cell(22,10,'Estado',1,0,'C');
            $this->fpdf->Cell(22,10,'Registro',1,1,'C'); 
            if ($pedidos->isEmpty()) {
                $this->fpdf->Cell(20, 20, 'No se encuentran resultados', 1, 1, 'C');
            } else {
                foreach ($pedidos as $pedidos) {
                    $this->fpdf->SetX(7);
                    $this->fpdf->Cell(14, 10, $pedidos->pedido_id, 1, 0, 'C');
                     $this->fpdf->Cell(22, 10, $pedidos->producto_id, 1, 0, 'C');
                     $this->fpdf->Cell(14, 10, $pedidos->Cantidad, 1, 0, 'C');
                     $this->fpdf->Cell(22, 10, $pedidos->Estado, 1, 0, 'C');
                    $this->fpdf->Cell(22, 10, $pedidos->updated_at, 1, 1, 'C');        
                }
            }
            $this->footer();
            $this->fpdf->Output();
            exit();
        }
    }
}
