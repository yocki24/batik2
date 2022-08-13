<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Batik Ciprat Langitan</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700"> 
    <link rel="stylesheet" href="{{ asset('shopper') }}/fonts/icomoon/style.css">
    
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{ asset('shopper') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('shopper') }}/css/magnific-popup.css">
    <link rel="stylesheet" href="{{ asset('shopper') }}/css/jquery-ui.css">
    <link rel="stylesheet" href="{{ asset('shopper') }}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('shopper') }}/css/owl.theme.default.min.css">


    <link rel="stylesheet" href="{{ asset('shopper') }}/css/aos.css">

    <link rel="stylesheet" href="{{ asset('shopper') }}/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
        @yield('css')  
  </head>
  <body>
      <!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top flex-nowrap" >
      <div class="d-flex flex-row" style="margin-bottom:0; margin-top:10px; height:40px;">
            @if (Route::has('login'))
                @auth
                <div class="dropdown" style="padding:0; width:90px">
                  <a class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style= "color:white">
                    <span class="icon icon-person" style= "color:white">
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="top:70%">
                    <a class="dropdown-item" style="display: inline; padding:0" href="{{ route('user.alamat') }}">Setting Alamat</a>
                    <a class="dropdown-item" style="display: inline; padding:0" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">
                      <i class="mdi mdi-logout text-primary"></i>&nbsp&nbsp&nbsp Logout 
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                  </div>
                </div>
                &nbsp&nbsp
                  <?php
                     $user_id = auth()->user()->id;
                    $total_keranjang = \DB::table('keranjang')
                    ->select(DB::raw('count(id) as jumlah'))
                    ->where('user_id',$user_id)
                    ->first();
                  ?>
            
                  <a href="{{ route('user.keranjang') }}" class="site-cart">
                   <span class="icon icon-add_shopping_cart" style= "color:white" class="count">&nbsp{{ $total_keranjang->jumlah }}</span>
                  </a>&nbsp&nbsp&nbsp&nbsp&nbsp

                  <?php
                    $user_id = auth()->user()->id;
                    $total_order = \DB::table('order')
                    ->select(DB::raw('count(id) as jumlah'))
                    ->where('user_id',$user_id)
                    ->where('status_order_id','!=',5)
                    ->where('status_order_id','!=',6)
                    ->first();
                  ?>

                  <a href="{{ route('user.order') }}" class="site-cart" style="width: 30px">
                    <span class="icon icon-shopping_cart" style= "color:white" class="count">&nbsp{{ $total_order->jumlah }} </span>
                  </a>

                  <div class="d-inline-block d-md-none ml-md-0 col-sm" style="padding: 0; left: 50px">
                      <a href="#" class="site-menu-toggle js-menu-toggle">
                        <div class="dropdown" style="width:50px; margin:0px;">
                          <a class="btn btn-secondary dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="false">
                            Ξ
                          </a>
                          <div class="dropdown-menu " style="width: 50px; margin:0;">
                            <li class="nav-item {{ Request::path() === '/' ? '' : '' }}">
                              <a class="nav-link" href="{{ route('home') }}" style= "color:black"><strong>Beranda</strong></a>
                            </li>
                            <li class="nav-item {{ Request::path() === 'produk' ? '' : '' }}">
                              <a class="nav-link" href="{{ route('user.produk') }}" style= "color:black"><strong>Produk</strong></a>
                            </li>
                            <li class="nav-item {{ Request::path() === '/' ? '' : '' }}">
                              <a class="nav-link" href="{{ url('tentang') }}" style= "color:black"><strong>About Us</strong></a>
                            </li>
                          </div>
                        </div> 
                      </a>
                  </div>
                  @else 
                    <div class="dropdown col-sm" style="width:200px; padding:0">
                      <a class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style= "color:white">
                        <span class="icon icon-person" style= "color:white"></span>
                      </a>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{ route('login') }}">Login</a>
                          @if (Route::has('register'))
                        <a class="dropdown-item" href="{{ route('register') }}">Register</a>
                        @endif
                      </div>
                    </div>
                    <div class="d-inline-block d-md-none ml-md-0 col-sm" style="padding-bottom:10px; float:right">
                      <a href="#" class="site-menu-toggle js-menu-toggle">
                        <div class="dropdown row" style="width: 10px">
                          <div class="col">
                            <a class="btn btn-secondary dropdown-toggle" role="button" data-toggle="dropdown" aria-expanded="false">
                              Ξ
                            </a>
                            <div class="dropdown-menu ">
                              <li class="nav-item {{ Request::path() === '/' ? '' : '' }}">
                                <a class="nav-link" href="{{ route('home') }}" style= "color:black"><strong>Beranda</strong></a>
                              </li>
                              <li class="nav-item {{ Request::path() === 'produk' ? '' : '' }}">
                                <a class="nav-link" href="{{ route('user.produk') }}" style= "color:black"><strong>Produk</strong></a>
                              </li>
                              <li class="nav-item {{ Request::path() === '/' ? '' : '' }}">
                                <a class="nav-link" href="{{ url('tentang') }}" style= "color:black"><strong>About Us</strong></a>
                              </li>
                            </div>
                          </div>
                        </div> 
                      </a>
                    </div>
                @endauth
            @endif   
          </div>
          <div class="col-6 col-md-2 order-2 order-md-1 site-search-icon text-right" style="width: 70px;">
            <form action="{{ route('user.produk.cari') }}" method="get" class="site-block-top-search" style="width: 150px">
              @csrf
              <span class="icon icon-search2" style="padding:10px"></span>
              <input type="text" class="form-control border-0" name="cari" placeholder="Cari">
            </form>
          </div>
        </div>
      </div>
      
      <div class="collapse navbar-collapse" id="navbarResponsive" style="margin:0; padding:0">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item {{ Request::path() === '/' ? '' : '' }}">
            <a class="nav-link" href="{{ route('home') }}" style= "color:white"><strong>Beranda</strong></a>
          </li>
          <li class="nav-item {{ Request::path() === 'produk' ? '' : '' }}">
            <a class="nav-link" href="{{ route('user.produk') }}" style= "color:white"><strong>Produk</strong></a>
          </li>
          <li class="nav-item {{ Request::path() === '/' ? '' : '' }}">
            <a class="nav-link" href="{{ url('tentang') }}" style= "color:white"><strong>About Us</strong></a>
          </li>

          <!-- <li class="nav-item">
            <a class="nav-link" href="#">Profil</a>
          </li> -->
          {{-- <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-right">
              <form action="{{ route('user.produk.cari') }}" method="get" class="site-block-top-search" >
                @csrf
                <span class="icon icon-search2"></span>
                <input type="text" class="form-control border-0" name="cari" placeholder="Cari">
              </form>
          </div> --}}
        </ul>
      </div>
    </div>
  </nav>
  <br><br>    
  <!--navigation-->

    @yield('content')
    
    <footer>
		<div class="footer-bottom">
			<div class="container">
				<div class="row d-flex">
					<p class="col-lg-12 footer-text text-center">
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            <font color="black"> Copyright &copy;<script>document.write(new Date().getFullYear());</script> <font color="black"><strong>Batik Ciprat Langitan Simbatan</strong>
        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
				</div>
			</div>
		</div>
	</footer>
	<!--================ End footer Area  =================-->
          
        </div>
      </div>
    </footer>
  </div>

  <script src="{{ asset('shopper') }}/js/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
  <script src="{{ asset('shopper') }}/js/jquery-ui.js"></script>
  <script src="{{ asset('shopper') }}/js/popper.min.js"></script>
  <script src="{{ asset('shopper') }}/js/bootstrap.min.js"></script>
  <script src="{{ asset('shopper') }}/js/owl.carousel.min.js"></script>
  <script src="{{ asset('shopper') }}/js/jquery.magnific-popup.min.js"></script>
  <script src="{{ asset('shopper') }}/js/aos.js"></script>

  <script src="{{ asset('shopper') }}/js/main.js"></script>
    @yield('js')
  </body>
</html>