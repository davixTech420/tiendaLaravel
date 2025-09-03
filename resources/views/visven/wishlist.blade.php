@include('partials.nav')

 <div class="container mt-3">
  <div class="sup container text-center">
  <Center> <i style="margin-top:-100px;" class="fas fa-heart"></i></Center>
  <br> 
  <h2>My Wishlist</h2>
  </div>
   
    <table class="table">
      <br>
      @if($producto->isEmpty())
      <div class="alert alert-danger" role="alert">
      <h4 class="alert-heading">No se encontraron resultados</h4>
      <p>Lo sentimos, pero no pudimos encontrar resultados para tu consulta.</p>
      <hr>
    </div>
      @else
      <thead>
        <tr>
          <th>Producto</th>
          <th>Precio x Unidad</th>
          <th>Unidades</th>
          <th></th>
        </tr>
      </thead>
      @foreach ($producto as $producto)
      <tbody>
        <tr>
          <td><img src="{{  asset($producto->imagen) }}" width="61px" height="60px"><br>
          {{ $producto->Nombre }}</td>
          <td>${{ $producto->Precio }}</td>
          <td>@if($producto->stock > 0) <span class="badge bg-success">En Stock</span> @else <span class="badge bg-danger">Sin Stock</span> @endif</td>
          <td><a href="{{ route('elimDESE',[Auth('cliente')->id(), $producto->id]) }}" > <i class="bi-dash"></i>  </a> </td>

         
        </tr>
        <!-- Add more products as needed -->
      </tbody>
      @endforeach
      @endif
    </table>
  </div>


@include('partials.footer')