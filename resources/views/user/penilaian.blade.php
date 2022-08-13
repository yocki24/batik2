<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Batik Ciprat Langitan</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Mukta:300,400,700"> 
    <link rel="stylesheet" href="{{ asset('shopper') }}/fonts/icomoon/style.css">

    <link rel="stylesheet" href="{{ asset('shopper') }}/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('shopper') }}/css/magnific-popup.css">
    <link rel="stylesheet" href="{{ asset('shopper') }}/css/jquery-ui.css">
    <link rel="stylesheet" href="{{ asset('shopper') }}/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('shopper') }}/css/owl.theme.default.min.css">


    <link rel="stylesheet" href="{{ asset('shopper') }}/css/aos.css">

    <link rel="stylesheet" href="{{ asset('shopper') }}/css/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
  </head>
  <body>
  
  <div class="site-wrap">
    <header class="site-navbar" role="banner">
      <div class="site-navbar-top">
        <div class="container">
          <div class="row align-items-center">

            <div class="col-6 col-md-4 order-2 order-md-1 site-search-icon text-left">
              <form action="{{ route('user.produk.cari') }}" method="get" class="site-block-top-search" >
                @csrf
                <span class="icon icon-search2"></span>
                <input type="text" class="form-control border-0" name="cari" placeholder="Search">
              </form>
            </div>

            <div class="col-12 mb-3 mb-md-0 col-md-4 order-1 order-md-2 text-center">
              <div class="site-logo">
                <h1><strong>Welcome Batik Ciprat Langitan Simbatan</strong></h1>
                <i class="icon-cart-arrow-down" aria-hidden="true"></i> <target="_blank" class="text-primary"><strong>Welcome To Batik Ciprat Langitan Simbatan...</strong>
              </div>
            </div>

            <div class="col-6 col-md-4 order-3 order-md-3 text-right">
            <div class="top-right links"> 
            <div class="site-top-icons">
              <ul>
              @if (Route::has('login'))
                    @auth
                        <li>
                          <div class="dropdown">
                            <a class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="icon icon-person"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ route('user.alamat') }}">Setting Alamat</a>
                                <a class="dropdown-item" href="#">
                                
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                  onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                  <i class="mdi mdi-logout mr-2 text-primary"></i> Logout 
                              </a>

                              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                  @csrf
                              </form>
                            </div>
                            </div>
                        </li>
                        <li>
                          <?php
                            $user_id = auth()->user()->id;
                            $total_keranjang = \DB::table('keranjang')
                            ->select(DB::raw('count(id) as jumlah'))
                            ->where('user_id',$user_id)
                            ->first();
                          ?>
                            <a href="{{ route('user.keranjang') }}" class="site-cart">
                            <span class="icon icon-add_shopping_cart"></span>
                            <span class="count">{{ $total_keranjang->jumlah }}</span>
                            </a>
                        </li> 
                        <li>
                        <?php
                            $user_id = auth()->user()->id;
                            $total_order = \DB::table('order')
                            ->select(DB::raw('count(id) as jumlah'))
                            ->where('user_id',$user_id)
                            ->where('status_order_id','!=',5)
                            ->where('status_order_id','!=',6)
                            ->first();
                          ?>
                        <a href="{{ route('user.order') }}" class="site-cart">
                            <span class="icon icon-shopping_cart"></span>
                            <span class="count">{{ $total_order->jumlah }}</span>
                            </a>
                        </li>
                    @else
                    <div class="dropdown">
                            <a class="dropdown-toggle" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="icon icon-person"></span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ route('login') }}">Login</a>
                                @if (Route::has('register'))
                                  <a class="dropdown-item" href="{{ route('register') }}">Register</a>
                                @endif
                            </div>
                            </div>
                    @endauth
                </div>
            @endif
            <li class="d-inline-block d-md-none ml-md-0"><a href="#" class="site-menu-toggle js-menu-toggle"><span class="icon-menu"></span></a></li>
            </div>
            </ul>
            </div> 
          </div>
        </div>
      </div> 
      <nav class="site-navigation text-right text-md-center" role="navigation">
        <div class="container">
          <ul class="site-menu js-clone-nav d-none d-md-block">
            <li class="{{ Request::path() === '/' ? '' : '' }}"><a href="{{ route('home') }}"><strong>Beranda</strong></a></li>
            <li class="{{ Request::path() === 'produk' ? '' : '' }}"><a href="{{ route('user.produk') }}"><strong>Produk</strong></a></li>
            <li class="{{ Request::path() === '/' ? '' : '' }}"><a href="{{ url('tentang') }}"><strong>Tentang</strong></a></li>
          </ul>
        </div>
         <!-- Penilaian Produk-->
         <section class="page-section" id="kritiksaran">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-lg-8 col-xl-6 text-center">
                        <h2 class="mt-0">Penilaian Produk</h2>
                        <hr class="divider" />
                        <p class="text-muted mb-5">Sampaikan Penilaian Anda</p>
                    </div>
                </div>
                <div class="row gx-4 gx-lg-5 justify-content-center mb-5">
                    <div class="col-lg-6">
                        <!-- * * * * * * * * * * * * * * *-->
                        <!-- * * SB Forms Contact Form * *-->
                        <!-- * * * * * * * * * * * * * * *-->
                        <!-- This form is pre-integrated with SB Forms.-->
                        <!-- To make this form functional, sign up at-->
                        <!-- https://startbootstrap.com/solution/contact-forms-->
                        <!-- to get an API token!-->
                        
                        @if ( Session::has('pesan'))
							<div class="alert alert-success">
                                <h5>Penilaian Terkirim !</h5>
							    <p>Terima kasih telah memberikan kami feedback</p>
						    </div>
						@endif

                        <form action="penilaian/create" method="POST">
                            @csrf
                            <!-- Name input-->

                            <input type="hidden" name="id" value="{{ get_client_id() }}" />

                            <div class="form-floating mb-3">
                                <input class="form-control" name="nama" type="text" placeholder="Masukkan nama Anda..." data-sb-validations="required" />
                                <label for="name">Nama Lengkap</label>
                                @error('nama')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                <div class="invalid-feedback" data-sb-feedback="name:required">A name is required.</div>
                            </div>
                            <!-- Email address input-->
                            <div class="form-floating mb-3">
                                <input class="form-control" name="email" type="email" placeholder="name@example.com" data-sb-validations="required,email" />
                                <label for="email">Alamat Email</label>
                                @error('email')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                <div class="invalid-feedback" data-sb-feedback="email:required">An email is required.</div>
                                <div class="invalid-feedback" data-sb-feedback="email:email">Email is not valid.</div>
                            </div>
                            <!-- Message input-->
                            <div class="form-floating mb-3">
                                <textarea class="form-control" name="pesan" type="text" placeholder="Masukkan Kritik dan Saran..." style="height: 10rem" data-sb-validations="required"></textarea>
                                <label for="message">Isi Penilaian Produk</label>
                                @error('pesan')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                <div class="invalid-feedback" data-sb-feedback="message:required">A message is required.</div>
                            </div>
                            <!-- Submit success message-->
                            <!---->
                            <!-- This is what your users will see when the form-->
                            <!-- has successfully submitted-->
                            <div class="d-none" id="submitSuccessMessage">
                                <div class="text-center mb-3">
                                    <div class="fw-bolder">Form submission successful!</div>
                                    To activate this form, sign up at
                                    <br />
                                    <a href="https://startbootstrap.com/solution/contact-forms">https://startbootstrap.com/solution/contact-forms</a>
                                </div>
                                <link rel="stylesheet" type="text/css" href="style.css">
  <title>Star rating using pure CSS</title>
</head>
<style>
body {
    background-color: #E0FFFF
}
.card {
    width: 350px;
    border: none;
    box-shadow: 5px 6px 6px 2px #e9ecef;
    border-radius: 12px
}
.circle-image img {
    border: 6px solid #fff;
    border-radius: 100%;
    padding: 0px;
    top: -28px;
    position: relative;
    width: 70px;
    height: 70px;
    border-radius: 100%;
    z-index: 1;
    background: #e7d184;
    cursor: pointer
}
.dot {
    height: 18px;
    width: 18px;
    background-color: cyan;
    border-radius: 50%;
    display: inline-block;
    position: relative;
    border: 3px solid #000000;
    top: -48px;
    left: 186px;
    z-index: 1000
}
.name {
    margin-top: -21px;
    font-size: 18px
}
.fw-500 {
    font-weight: 500 !important
}
.start {
    color: green
}
.stop {
    color: red
}
.rate {
    border-bottom-right-radius: 12px;
    border-bottom-left-radius: 12px
}
.rating {
    display: flex;
    flex-direction: row-reverse;
    justify-content: center
}
.rating>input {
    display: none
}
.rating>label {
    position: relative;
    width: 1em;
    font-size: 30px;
    font-weight: 300;
    color: #FFD600;
    cursor: pointer
}
.rating>label::before {
    content: "\2605";
    position: absolute;
    opacity: 0
}
.rating>label:hover:before,
.rating>label:hover~label:before {
    opacity: 1 !important
}
.rating>input:checked~label:before {
    opacity: 1
}
.rating:hover>input:checked~label:before {
    opacity: 0.4
}
.buttons {
    top: 36px;
    position: relative
}
.rating-submit {
    border-radius: 15px;
    color: #fff;
    height: 49px
}
</style>
<div class="container d-flex justify-content-center mt-5">
    <div class="card text-center mb-5">
        <div class="circle-image"> <img src="https://i.imgur.com/hczKIze.jpg" width="50"> </div> <span class="dot"></span> <span class="name mb-1 fw-500">Bryan Williams</span> <small class="text-black-50">Tata Ace</small> <small class="text-black-50 font-weight-bold">QP09AA9090</small>
        <div class="location mt-4"> <span class="d-block"><i class="fa fa-map-marker start"></i> <small class="text-truncate ml-2">Ganesha Road, preet vihar new delhi</small> </span> <span><i class="fa fa-map-marker stop mt-2"></i> <small class="text-truncate ml-2">Mandir Road, Mayur vihar, new delhi</small> </span> </div>
        <div class="rate bg-success py-3 text-white mt-3">
            <h6 class="mb-0">Rate your driver</h6>
            <div class="rating"> <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label> <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label> <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label> <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label> <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label> </div>
            <div class="buttons px-4 mt-0"> <button class="btn btn-warning btn-block rating-submit">Submit</button> </div>
        </div>
    </div>
</div>
                            </div>
                            <!-- Submit error message-->
                            <!---->
                            <!-- This is what your users will see when there is-->
                            <!-- an error submitting the form-->
                            <div class="d-none" id="submitErrorMessage"><div class="text-center text-danger mb-3">Error sending message!</div></div>
                            <!-- Submit Button-->
                            <div class="d-grid"><button class="btn btn-primary btn-xl"  type="submit">Kirim</button></div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        </header>

    @yield('content')
    
    <footer class="site-footer border-top">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 mb-5 mb-lg-0">
            <div class="row">
              <div class="col-md-12">
              <footer class="footer">
		<div class="footer-area">
			<div class="container">
				<div class="row section_gap">
					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="block-5 mb-5">
							<h4 class="footer-heading mb-4">Our Mission</h4>
              <ul class="list-unstyled">
							<p>
                Memperkenalkan produk asli Batik Ciprat Langitan Desa Simbatan, dengan kualitas terbaik.
							</p>
							<p>
								Memperkenalkan produk lokal dengan kualitas internasional.
							</p>
						</div>
            </div>
					<div class="offset-lg-1 col-lg-2 col-md-6 col-sm-6">
						<div class="single-footer-widget tp_widgets">
							<h4 class="footer_title">Quick Links</h4>
							<ul class="list">
								<li><a href="">Home</a></li>
								<li><a href="">Produk</a></li>
								<li><a href="#">Tentang</a></li>
							</ul>
</div>
          	</div>
					<div class="offset-lg-1 col-lg-3 col-md-6 col-sm-6">
						<div class="single-footer-widget tp_widgets">
            <div class="block-5 mb-5">
              <h3 class="footer-heading mb-4">Contact Info</h3>
              <ul class="list-unstyled">
                <li class="address">Simbatan Wetan, Simbatan, Nguntoronadi, Kabupaten Magetan, Jawa Timur 63383</li>
                <li class="phone">0812-3189-6825</li>
                <li class="email">batikcipratlangitan@gmail.com</li>
              </ul>
            </div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="footer-bottom">
			<div class="container">
				<div class="row d-flex">
					<p class="col-lg-12 footer-text text-center">
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
        Copyright &copy;<script>document.write(new Date().getFullYear());</script> Batik Ciprat Langitan Simbatan |<i class="icon-shopping-bag" aria-hidden="true"></i> by <target="_blank" class="text-primary">BatikCiprat
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            </p>
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