<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Cupone;
use Illuminate\Http\Request;

/**
 * Class CuponeController
 * @package App\Http\Controllers
 */
class CuponeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
         $categoriasActivas = Categoria::Where('Estado','Activo')->select('Nombre','id')->get();
         if (request()->input('id')  ||  request()->input('cupon') || request()->input('fec_ini') || request()->input('fec_fin') || request()->input('categoria_id') || request()->input('Estado')) {
            // Si se están aplicando filtros, realizar la búsqueda
            $cupones = Cupone::query();
            if (request()->input('id')) {
                $cupones->where('id', 'LIKE', '%' . request()->input('id') . '%');
            }
            if (request()->input('cupon')) {
                $cupones->where('cupon', 'LIKE', '%' .  request()->input('cupon') . '%');
            }
            if (request()->input('fec_ini')) {
                $cupones->where('fec_ini', 'LIKE', '%' . request()->input('fec_ini') . '%');
            }
            if(request()->input('fec_fin')){
                $cupones->where('fec_fin','LIKE','%'.request()->input('fec_fin').'%');
            }
            if (request()->input('categoria_id')) {
                $categoriaId = (int)request()->input('categoria_id');
                $cupones->whereRaw("FIND_IN_SET(?, categorias) > 0", [$categoriaId]);
            }
            if(request()->input('Estado')){
                $cupones->Where('estado',request()->input('Estado'));
            }
             $cupones =   $cupones->paginate();
            return view('cupone.index', compact('cupones','categoriasActivas'))
            ->with('i', (request()->input('page', 1) - 1) * $cupones->perPage());
    }
    else{
        $cupones = Cupone::paginate();
            return view('cupone.index', compact('cupones','categoriasActivas'))
            ->with('i', (request()->input('page', 1) - 1) * $cupones->perPage());
    }
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cupone = new Cupone();
        $categorias = Categoria::Where('Estado','Activo')->select('Nombre','id')->get();
        return view('cupone.create', compact('cupone','categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Cupone::$rules);
    
        // Crea el cupón sin las categorías
        
//        dd(json_encode( $request->input('categorias')));
        $cupone = Cupone::create([
            'cupon' => $request->input('cupon'),
            'descuento' => $request->input('descuento'),
            'fec_ini' => $request->input('fec_ini'),
            'fec_fin' => $request->input('fec_fin'),
            'mul_usos' => $request->input('mul_usos'),
            'cantidad' => $request->input('cantidad'),
            'categorias' =>implode(',',$request->input('categorias')),
            'estado' => 'Activo',
        ]);
     $cupone->save();
        
    
        return redirect()->route('cupone.index')
            ->with('success', 'Cupone created successfully.');
    }
    

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function inactivar($id)
    {
        $cupone = Cupone::find($id);
        $cupone->estado = 'Inactivo';
        $cupone->save();

        return  redirect(route('cupone.index'))->with('success','Cupon Inactivado Exitosamente'); 
    }
    public function activar($id)
    {
        $cupone = Cupone::find($id);
        $cupone->estado = 'Activo';
        $cupone->save();

        return  redirect(route('cupone.index'))->with('success','Cupon Activado Exitosamente'); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cupone = Cupone::find($id);

        return view('cupone.edit', compact('cupone'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Cupone $cupone
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cupone $cupone)
    {
        request()->validate(Cupone::$rules);

        $cupone->update($request->all());

        return redirect()->route('cupone.index')
            ->with('success', 'Cupone updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $cupone = Cupone::find($id)->delete();

        return redirect()->route('cupone.index')
            ->with('success', 'Cupone deleted successfully');
    }
}
