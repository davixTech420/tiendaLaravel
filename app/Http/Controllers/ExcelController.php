
<?php
namespace App\Http\Controllers;

use App\Models\Users;
use App\Models\Producto;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{
    public function exportUsers()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function exportProducts()
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }
}

class UsersExport implements FromCollection
{
    public function collection()
    {
        return Users::all();
    }
}

class ProductsExport implements FromCollection
{
    public function collection()
    {
        return Producto::all();
    }
}
?>