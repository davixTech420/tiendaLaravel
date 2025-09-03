@include('partials.nav')
<!-- Product section-->
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
                <div class="container px-4 px-lg-5 my-5">
                    <div class="row gx-4 gx-lg-5 align-items-center" style="width: 500px">
                        <div class="col-md-6 zoomable-image" style="widht: 900px;"><img class="card-img-top mb-5 mb-md-0" src="{{  asset($producto->imagen) }}" width="600px" height="600px" />
                            <div class="d-flex justify-content-center small text-warning mb-2">
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="small mb-1">{{ $producto->Marca}}</div>
                            <h1 class="display-5 fw-bolder">{{$producto->Nombre}}
                                @if (Auth::guard('cliente')->check())
                                <!-- Aquí es donde accedes a la propiedad $enListaDeDeseos -->
                                @if (in_array($producto->id, $enListaDeDeseos))
                                <a href="{{ route('elimDESE',[Auth('cliente')->id(), $producto->id]) }}"> <i class="bi bi-heart-fill"></i></a>
                                @else
                                <a href="{{ route('añadDESE', [Auth('cliente')->id(), $producto->id]) }}" id="add-to-wishlist"> <i class="bi bi-heart"></i> </a>
                                @endif
                                @else
                                <a href="#" id="add-to-wishlist">
                                    <i class="bi bi-heart"></i></a>
                                @endif
                            </h1>
                            <div class="fs-5 mb-5">
                                <!--<span class="text-decoration-line-through">$45.00</span>-->
                                <span>${{$producto->Precio}}</span>
                            </div>
                            <p class="lead">{{ $producto->descripcion}}</p>
                            <div class="small mb-1">{{ $producto->categoria()->pluck('Nombre')->implode(',')  }}</div>
                            <div class="d-flex">
                                <input class="form-control text-center me-3" id="inputQuantity" type="num" value="1" style="max-width: 3rem" />
                                <button class="btn btn-outline-dark flex-shrink-0" type="button">
                                    <i class="bi-cart-fill me-1"></i>
                                    Add to cart
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Related items section-->
<section class="py-5 bg-light">
    <div class="container px-4 px-lg-5 mt-5">
        <h2 class="fw-bolder mb-4">Productos Relacionados {{ $producto->categoria()->pluck('Nombre')->implode(',')}} </h2>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
        <div class="swiper mySwiper">
                <div class="swiper-wrapper">
            @foreach($newpro as $producto)
                <div class="swiper-slide">
                <div class="icons">
                <h3>{{ $producto->Nombre}}</h3>
                </div>
                <div class="product-content">
                    <div class="product-img">
                        <a class="zoomable-image" href="{{ route('item',$producto->id) }}"><img  src="{{ asset($producto->imagen)}}"></a>
                    </div>
                </div>
                <div class="infe">
                    <a href="" class=""><i class="bi bi-cart"></i></a>
                    <span>${{$producto->Precio}}</span>
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
        </div>
    </div>
</section>   
            </div>
        </div>
    </div>
</section>
@include('partials.footer')