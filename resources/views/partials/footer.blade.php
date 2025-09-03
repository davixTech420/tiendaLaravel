<div class="fixed-bottom menflota" style="background: transparent; z-index:22; 
  display: flex;
  align-items: center;
  justify-content: center;" >
    <footer class=" text-center text-lg-start" style="background-color: transparent;">
        <!-- Contenido del pie de página -->
        <ul class="nav nav-pills nav-fill gap-2 p-1 small bg-primary rounded-5 shadow-sm" id="pillNav2" role="tablist" style="font-size:10px;  --bs-nav-link-color: var(--bs-white); --bs-nav-pills-link-active-color: var(--bs-primary); --bs-nav-pills-link-active-bg: var(--bs-white);width:400px;background-color:transparent;">
  <li class="nav-item" role="presentation">
    <a class="nav-link  rounded-5" id="home-tab2"  type="button" role="tab" href="{{ route('wishlist') }}" aria-selected="false"><i class="bi bi-heart-fill"></i></a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link rounded-5" id="profile-tab2"  type="button" role="tab" aria-selected="false" href="{{  route('welcome') }}"><i class="bi bi-house-fill"></i>
      </a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link rounded-5" id="contact-tab2" href="{{ route('car') }}"  type="button" role="tab" aria-selected="false"> <i class="bi bi-cart-plus"></i>
    <span class="badge badge-light">10</span>
 </a>
  </li>
</ul>
    </footer>
</div>
 <!-- Footer-->
  <!-- Footer -->
  <br> <br>
<footer class="text-center text-lg-start bg-body-tertiary text-muted final">
  <!-- Section: Social media -->
  <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom final">
    <!-- Left -->
    <div class="me-5 d-none d-lg-block">
      <span>Get connected with us on social networks:</span>
    </div>
    <!-- Left -->

    <!-- Right -->
    <div>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-facebook-f"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-twitter"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-google"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-instagram"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-linkedin"></i>
      </a>
      <a href="" class="me-4 text-reset">
        <i class="fab fa-github"></i>
      </a>
    </div>
    <!-- Right -->
  </section>
  <!-- Section: Social media -->

  <!-- Section: Links  -->
  <section class="final-content">
    <div class="container text-center text-md-start mt-5">
      <!-- Grid row -->
      <div class="row mt-3">
        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <!-- Content -->
          <h6 class="text-uppercase fw-bold mb-4">
            <i class="fas fa-gem me-3"></i>Company name
          </h6>
          <p>
            Here you can use rows and columns to organize your footer content. Lorem ipsum
            dolor sit amet, consectetur adipisicing elit.
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            Products
          </h6>
          <p>
            <a href="#!" class="text-reset">Angular</a>
          </p>
          <p>
            <a href="#!" class="text-reset">React</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Vue</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Laravel</a>
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            Useful links
          </h6>
          <p>
            <a href="#!" class="text-reset">Pricing</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Settings</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Orders</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Help</a>
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
          <p><i class="fas fa-home me-3"></i> New York, NY 10012, US</p>
          <p>
            <i class="fas fa-envelope me-3"></i>
            info@example.com
          </p>
          <p><i class="fas fa-phone me-3"></i> + 01 234 567 88</p>
          <p><i class="fas fa-print me-3"></i> + 01 234 567 89</p>
        </div>
        <!-- Grid column -->
      </div>
      <!-- Grid row -->
    </div>
  </section>
  <!-- Section: Links  -->

  <!-- Copyright -->
  <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
    © 2021 Copyright:
    <a class="text-reset fw-bold" href="https://mdbootstrap.com/">MDBootstrap.com</a>
  </div>
  <!-- Copyright -->
</footer>
<!-- Footer -->
    <!-- Bootstrap core JS-->
    <script>

    function mostrarPassword() {
    var x = document.getElementById("password");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  }
  document.addEventListener('DOMContentLoaded', function () {
    var tabLogin = document.getElementById('tab-login');
    var tabRegister = document.getElementById('tab-register');
    var pillsLogin = document.getElementById('pills-login');
    var pillsRegister = document.getElementById('pills-register');

    // Añadir un evento de clic a la pestaña de inicio de sesión
    tabLogin.addEventListener('click', function (e) {
        e.preventDefault();
        pillsLogin.classList.add('show', 'active');
        pillsRegister.classList.remove('show', 'active');
        tabLogin.classList.add('active');
        tabRegister.classList.remove('active');
    });

    // Añadir un evento de clic a la pestaña de registro
    tabRegister.addEventListener('click', function (e) {
        e.preventDefault();
        pillsRegister.classList.add('show', 'active');
        pillsLogin.classList.remove('show', 'active');
        tabRegister.classList.add('active');
        tabLogin.classList.remove('active');
    });
});



    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LrQ6wYHNdgIyKk" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>    
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        var swiper = new Swiper(".mySwiper", {
          effect: "coverflow",
          grabCursor: true,
          centeredSlides: true,
          slidesPerView: 'auto', // Cambiado a 'auto' para ajustar automáticamente el número de diapositivas según el contenedor
          loop: false,
          spaceBetween: 40,
          coverflowEffect: {
            depth: 500,
            modifier: 0,
            slideShadows: true,
            rotate: 0,
            stretch: 0,
          },
          initialSlide: -1,
          navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
          },
        });
      });
    </script>
</body>
</html>