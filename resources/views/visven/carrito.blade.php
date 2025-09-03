@include('partials.nav')
    <div class="container mt-5" id="carrito-container">
        <h1 class="mb-4">Carrito de Compras</h1>
        @if (session('carrito_' . md5(Auth::guard('cliente')->user()->id)))
        <table class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach (session('carrito_' . md5(Auth::guard('cliente')->user()->id)) as $item)
                    <tr>
                        <td>
                            <img src="{{ asset($pro->find($item['producto_id'])->imagen) }}" width="50px" height="50px"><br>
                            {{ $pro->find($item['producto_id'])->Nombre }}</td>
                        <td>{{ $item['cantidad'] }}</td>
                        <td>{{ $pro->find($item['producto_id'])->Precio }}</td>
                        <td>{{$tot_pro[] =  $item['cantidad'] * $pro->find($item['producto_id'])->Precio }}</td>
                        <td>
                            <a href="#" class="btn btn-danger">Eliminar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-info">
            El carrito está vacío. 
        </div>
    @endif
        <h2 class="mt-4">Total: $<span class="total-amount">{{  array_sum($tot_pro) }}</span></h2>
        <button class="btn btn-primary" id="checkout-btn">Realizar Pago</button>
    </div>
@include('partials.footer')