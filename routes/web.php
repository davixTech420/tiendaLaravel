 <?php


    use App\Http\Controllers\PdfController;
    use App\Http\Controllers\ExcelController;
    use App\Http\Controllers\ComentarioController;
    use App\Http\Controllers\CategoriaController;
    use App\Http\Controllers\CalificacionController;
    use App\Http\Controllers\ClienteController;
    use App\Http\Controllers\CuponeController;
    use App\Http\Controllers\DeselistController;
    use App\Http\Controllers\DetallePedidoController;
    use App\Http\Controllers\PedidoController;
    use App\Http\Controllers\ProductoController;
    use App\Http\Controllers\CartController;
    use App\Http\Controllers\ProfileController;
    use App\Models\categoria;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\UserController;
    use App\Http\Controllers\WelcomeController;
    use App\Models\Calificacion;
    use App\Models\Cliente;
    use App\Models\Producto;
    use App\Models\Pedido;
    use App\Models\Deselist;
    use App\Models\DetallePedido;
use App\Models\User;
use GuzzleHttp\Client;
    use Illuminate\Contracts\Cache\Store;
    use Illuminate\Foundation\Auth\EmailVerificationRequest;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Laravel\Socialite\Facades\Socialite;
    use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isEmpty;

    /*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




    Route::resource('/', WelcomeController::class, [
        'names' => [
            'index' => 'welcome',
        ],
    ]);




    route::get('/item/{id}', WelcomeController::class . '@item')->name('item');
    //vista del carrito de compras
    route::get('/car', WelcomeController::class . '@carrito')->name('car')->middleware('auth.cliente');


    /**
     * RUTA PARA AGREGAR AL CARRITO DE COMPRAS
     */
    route::get('/addCart/{id}', CartController::class . '@addCart')->name('addCart')->middleware('auth.cliente');

     /** */


    //VISTA DE LOGIN Y RESGISTRO PARA EL CLIENTE
    route::get('/logi', WelcomeController::class . '@login')->name('logi');
     /**
     * Codigo para verificar el correo del cliente
     */
    route::get('/veriCORR',WelcomeController::class.'@veriCORRE')->name('veriCORR');
     /** */
     /**Esta ruta es para la lista de deseos del clente desde la vista de cleinte 
      * */
route::get('/wishlist', WelcomeController::class . '@wishlist')->name('wishlist')->middleware('auth.cliente');
      /*
      **
      */


    Route::get('/dashboard', function () {
        $cliente = Cliente::Where('Estado', 'Activo')->get();
        $producto = Producto::Where('Estado', 'Activo')->get();
        $pedido = Pedido::Where('Estado', 'Activo')->get();
        $categoria = Categoria::Where('Estado', 'Activo')->get();
        /**
         * este codigo es para los graficos del dashboard
         */
        $pedidos = Pedido::where('created_at', '>=', now()->subDays(30))->get();
        /** */
        /*
    Este codigo nos muestra el producto mas agregado a la lista de deseos en los ultimos 30 dias
    */
   //aca obtenemos el producto que mas esta en nuestra tabla de deselist
   if (Deselist::count() == 0)   {
       $deseos = 0;
       $deseos_incrementados = 0;
       $porcentaje_incremento = 0;
       $progress_description = 0;
   } else{ 
   $deseos =  DB::table('deselists')
            ->select('producto_id')
            ->groupBy('producto_id')
            ->orderByRaw('COUNT(*) DESC')
            ->limit(1)
            ->first()
            ->producto_id;
        //calculamos los productos que se han agregado en los ultimos 30 dias
        $deseos_incrementados = DB::table('deselists')
            ->where('producto_id', $deseos)
            ->whereDate('created_at', '>=', Carbon::now()->subDays(30))
            ->count();
        //volvemos ese valor en porcentaje y lo mandamos a la vista
        $porcentaje_incremento = ($deseos_incrementados * 100) / $deseos;
        $porcentaje_incremento = round($porcentaje_incremento, 1);
        $progress_description = "{$porcentaje_incremento}% Incremento De Los Ultimos 30 Dias";
   }
        return view('dashboard', compact(
            'cliente',
            'producto',
            'pedido',
            'pedidos',
            'categoria',
            'deseos',
            'deseos_incrementados',
            'porcentaje_incremento',
            'progress_description',
        ));
    })->middleware(['auth', 'verified'])->name('dashboard');


    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });



    //rutas del administrador
    Route::resource('/users', UserController::class, [
        'names' => [
            'index' => 'users.index',
            // Otras opciones aquí
        ],
    ])->middleware('auth');
    //activar o inactivar el administrador
    Route::get('/inacA/{id}', UserController::class . '@inactivar')->name('inacA');
    route::get('/actiA/{id}', UserController::class . '@activar')->name('actiA');
    //reporte de excel y pdf del administrador 
    Route::get("/pdfAD", PdfController::class . '@indexAD')->name('pdfAD');
    Route::get("/ExcAdm", ExcelController::class . '@indexAD')->name('ExcAdm');




    //RUTAS DE PRODUCTOS
    Route::resource("/productos", ProductoController::class, [
        "names" => [
            'index' => 'productos.index',
        ],
    ])->middleware('auth');
    //activar o inactivar
    Route::get('/inac/{id}', ProductoController::class . '@inactivar')->name('inac');
    route::get('/acti/{id}', ProductoController::class . '@activar')->name('acti');
    //reporte de pdf
    Route::get('/pdf', PdfController::class . '@indexPRO')->name('pdfPRO');




    //RUTAS DE CLIENTES
    Route::resource("/clientes", ClienteController::class, [
        "names" => [
            "index" => "cliente.index",
        ],
    ])->middleware('auth');
    //CERRAR SESION DEL CLIENTE
    route::get('/logout', ClienteController::class . '@logout')->name('logout');
    //LOGIN Y REGISTRO DEL CLIENTE

//LOGIN DE GOOGLE PARA EL CLIENTE
    Route::get('/login-google', function () {
        return Socialite::driver('google')->redirect();
    })->name('login-google');
     
    Route::get('/google-callback', function () {
     $user_google = Socialite::driver('google')->user();
$user = Cliente::firstWhere('email', $user_google->email);
 if ($user)
 {
    return redirect(route('logi'))->with('error', 'Email Ya Registrado En El Sistema');
 }


        $user = Cliente::updateOrCreate([
            'google_id' => $user_google->id
        ], [
            'Nombre' => $user_google->name,
            'Email' => $user_google->email,
            'Estado' => 'Activo'
        ]);
    
        Auth::guard('cliente')->login($user);
        return redirect('/');
        // $user->token
    });
//
//LOGIN DE facebook PARA EL CLIENTE
Route::get('/login-face', function () {
    return Socialite::driver('facebook')->redirect();
})->name('login-face');
Route::get('/facebook-callback', function () {
    $user_face = Socialite::driver('facebook')->user();
    if (Cliente::firstWhere('email', $user_face->email))
    {
       return redirect(route('logi'))->with('error', 'Email Ya Registrado En El Sistema');
    }
    $user = Cliente::updateOrCreate([
        'google_id' => $user_face->id
    ], [
        'Nombre' => $user_face->name,
        'Email' => $user_face->email,
        'Estado' => 'Activo'
    ]);

    Auth::guard('cliente')->login($user);
    return redirect('/');
    // $user->token
});
//
    Route::post('/regis', ClienteController::class . '@register')->name('regis');
    Route::post('/logCL', ClienteController::class . '@login')->name('logCL');
    //activar o inactivar cliente
    Route::get('/inacCL/{id}', ClienteController::class . '@inactivar')->name('inacCL');
    route::get('/actiCL/{id}', ClienteController::class . '@activar')->name('actiCL');
    //reporte de pdf
    Route::get('/pdfCL', PdfController::class . '@indexCL')->name('pdfCL');


    //RUTAS DE LISTA DE DESEOS
    Route::resource("/deselists", DeselistController::class, [
        "names" => [
            "index" => "deselists.index",
        ],
    ])->middleware('auth');
    //pdf para la lista de deseos
    route::get('/pdfDESE', PdfController::class . '@indexDESE')->name('pdfDESE');
    //añadir un producto a la lista de deseos
    route::get("/añadDESE/{cli}/{pro}", DeselistController::class . '@añadir')->name('añadDESE')->middleware('auth:cliente');
    //elimianr un producto de la lista de deseos del cliente
    route::get("/elimDESE/{cli}/{pro}", DeselistController::class . '@eliminar')->name('elimDESE');
    /**
     * Vista para la crud de comentarios en la vista del administrador
     */
    route::resource('/comentario', ComentarioController::class, [
        "names" => [
            "index" => "comentario.index",
        ]
    ])->middleware('auth');
    //Ruta para crear el pdf de los comentarios 
    route::get('/pdfCOM',PdfController::class.'@indexCOM')->name('pdfCOM');





 

    //RUTAS DE CATEGORIAS
    Route::resource("/categorias", CategoriaController::class, [
        "names" => [
            "index" => "categoria.index",
        ]
    ])->middleware('auth');
    Route::get('/inacCA/{id}', CategoriaController::class . '@inactivar')->name('inacCA');
    route::get('/actiCA/{id}', CategoriaController::class . '@activar')->name('actiCA');
    route::get('/pdfCA', PdfController::class . '@indexCA')->name('pdfCA');



    //RUTAS DE LOS PROCDUTOS DEL PEDIDO
    Route::resource('/detalle_pedidos', DetallePedidoController::class,  [
        "names" => [
            "index" => "detalle_pedido.index",
        ],
    ])->middleware('auth');
    //ESTA RUTA ES PARA LOS REPORTES DE EXCEL Y PDF DE LO PRODUCTOS DEL PEDIDO
    route::get('/pdfDETPE',PdfController::class.'@indexDETPE')->name('pdfDETPE')->middleware('auth');
    //ESTAS RUTAS SON PARA ATIVAR O INAVTIVAR LOS PRODUCTOS DE LOS PEDIDOS
    route::get('/inacDP/{id}', DetallePedidoController::class . '@inactivar')->name('inacDP')->middleware('auth');
    route::get('/actiDP/{id}', DetallePedidoController::class . '@activar')->name('actiDP')->middleware('auth');


    //PEDIDOS 
    Route::resource('/pedidos', PedidoController::class, [
        "names" => [
            "index" => "pedidos.index",
        ],
    ])->middleware('auth');
//RUTA PARA EL REPORTE DE PDF Y EXCEL DE LOS PEDIDOS
route::get('/pdfPEDI',PdfController::class.'@indexPEDI')->name('pdfPEDI')->middleware('auth');
    //RUTAS PARA INACTIVAR Y ACTIVAR EL PEDIDO
    route::get('/inacPE/{id}', PedidoController::class . '@inactivar')->name('inacPE')->middleware('auth');
    route::get('/actiPE/{id}', PedidoController::class . '@activar')->name('actiPE')->middleware('auth');

    /**
     * estas rutas son para los cupones de descuento
     */
    route::resource('/cupones', CuponeController::class, [
        "names" => [
            "index" => "cupone.index",
        ],
    ])->middleware('auth');

    //rutas para ctivar e inactivar cupones
    route::get('/inaCUPO/{id}', CuponeController::class . '@inactivar')->name('inaCUPO');
    route::get('/actiCUPO/{id}', CuponeController::class . '@activar')->name('actiCUPO');
//estta ruta es para el pdf de los cupones
route::get('/pdfCUP', PdfController::class.'@indexCUP')->name('pdfCUPO');



    /**
     * 
     */



    /**
     * Estas son las ruta de la calificaicon de estrellas en la vista del administrador
     */
    Route::resource('/calificacion', CalificacionController::class, [
        "names" => [
            "index" => "calificacion.index",

        ],
    ])->middleware('auth');
//pdf de las calificaciones
route::get('/pdfCALI', PdfController::class.'@indexCALI')->name('pdfCALI');

    /**
     * 
     */

    require __DIR__ . '/auth.php';
