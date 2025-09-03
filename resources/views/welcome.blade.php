@include('partials.nav')
<!-- Header -->
<header class="bg-light py-5">
    <!-- CODIGO DE CARRUSEL -->
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach ($produc as $index => $pro)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <img src="{{ asset($pro->imagen) }}" width="100%" height="400px">
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</header>
<!-- Section-->
<section class="py-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">      
        <div class="container sticky-sidebar"> 
                        @foreach ($categoriasActivas as $categoria)                           
                                <a  href="#" class="category-link">{{ $categoria->Nombre }}</a>                            
                        @endforeach
                </div>               
        </div>    
    <div class="col-md-10">
        <div>
            <div class="container px-4 px-lg-5 mt-5">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
             <h1>Productos Nuevos</h1> 
             <div class="swiper mySwiper">
                <div class="swiper-wrapper">
            @foreach($newpro as $producto)
                <div class="swiper-slide">

                <div class="icons">
                    <p class="text-xs">${{ $producto->Nombre }}</p>
                </div>
            <div class="product-content">   
                <div class="product-img">
                    <a class="zoomable-image" href="{{ route('item',$producto->id) }}"><img  src="{{ asset($producto->imagen)}}"></a>
                </div>
               </div>
               <div class="infe">
                <a href="{{ route('addCart',$producto->id) }}" class="button button-primary"> <i class="bi bi-cart"></i></a>
                <span>${{ $producto->Precio}}</span>
                @if (Auth::guard('cliente')->check())                                                               
                <!-- Aquí es donde accedes a la propiedad $enListaDeDeseos -->
                @if (in_array($producto->id, $enListaDeDeseos))
                <a href="{{ route('elimDESE',[Auth('cliente')->id(), $producto->id]) }}" class="corazon"> <i class="bi bi-heart-fill"></i></a>    
                @else
                <a href="{{ route('añadDESE', [Auth('cliente')->id(), $producto->id]) }}" class="corazon"  id="add-to-wishlist">   <i class="bi bi-heart"></i>  </a> 
                @endif                                
        @else
        <a onclick="Swal.fire('Debes iniciar sesión para añadir el producto a la lista de deseos')" class="corazon">                      
        <i class="bi bi-heart"></i></a> 
        @endif 
               </div>
               
                </div>
                @endforeach
               </div>
               <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div>
                </div>

<!--PRUEBAS -->      
<h1>Productos</h1>
<div class="swiper mySwiper">
    <div class="swiper-wrapper">
@foreach($produc as $producto)
    <div class="swiper-slide">
    <div class="icons">
        <h3>{{ $producto->Nombre }}</h3>
    </div>
    
    <div class="product-content">
        <div class="product-img">
            <a class="zoomable-image" href="{{ route('item',$producto->id) }}"><img class="card-img-top" src="{{ asset($producto->imagen)  }}"></a>
        </div>
    </div>
    <div class="infe">
        <a href=""><i class="bi bi-cart"></i></a>
        <span>${{ $producto->Precio}}</span>
        @if (Auth::guard('cliente')->check())                                                               
        <!-- Aquí es donde accedes a la propiedad $enListaDeDeseos -->
        @if (in_array($producto->id, $enListaDeDeseos))
        <a href="{{ route('elimDESE',[Auth('cliente')->id(), $producto->id]) }}" class="corazon"> <i class="bi bi-heart-fill"></i></a>    
        @else
        <a href="{{ route('añadDESE', [Auth('cliente')->id(), $producto->id]) }}" class="corazon"  id="add-to-wishlist">   <i class="bi bi-heart"></i>  </a> 
        @endif                                
@else
<a  id="add-to-wishlist" onclick="Swal.fire('Debes iniciar sesión para añadir el producto a la lista de deseos')" class="corazon">                      
<i class="bi bi-heart"></i></a> 
@endif 

   </div>
    </div>
    @endforeach
   </div>
   <div class="swiper-button-prev"></div>
  <div class="swiper-button-next"></div>
    </div>


    <!-- -->


                </div>
            </div>
        </div>
    </div>
</div>
</div>
</section>
@section('css')

@stop
@section('js')
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2.min.js') }}"></script>




@stop

@include('partials.footer')