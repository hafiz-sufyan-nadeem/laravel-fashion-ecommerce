<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
       <meta name="csrf-token" content="{{ csrf_token() }}">
       <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Eflyer</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/bootstrap.min.css')}}">
      <!-- style css -->
      <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/style.css')}}">
      <!-- Responsive-->
      <link rel="stylesheet" href="{{asset('frontend/css/responsive.css')}}">
      <!-- fevicon -->
      <link rel="icon" href="{{asset('frontend/images/fevicon.png')}}" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="{{asset('frontend/css/jquery.mCustomScrollbar.min.css')}}">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <!-- fonts -->
      <link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
      <!-- font awesome -->
      <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <!--  -->
      <!-- owl stylesheets -->
      <link href="https://fonts.googleapis.com/css?family=Great+Vibes|Poppins:400,700&display=swap&subset=latin-ext" rel="stylesheet">
      <link rel="stylesheet" href="{{asset('frontend/css/owl.carousel.min.css')}}">
      <link rel="stylesoeet" href="{{asset('frontend/css/owl.theme.default.min.css')}}">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
       <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

   </head>
   <body>
      <!-- banner bg main start -->
      <div class="banner_bg_main">

         <!-- header top section start -->
          @include('frontend.layouts.header')
         <!-- header top section end -->

         <!-- logo section start -->
         <div class="logo_section">
            <div class="container">
               <div class="row">
                  <div class="col-sm-12">
                     <div class="logo"><a href="index.html"><img src="{{asset('frontend/images/logo.png')}}"></a></div>
                  </div>
               </div>
            </div>
         </div>
         <!-- logo section end -->

          <!-- header section start -->
          <div class="header_section">
              <div class="container">
                  <div class="containt_main">

                      <div class="dropdown">
                          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">All Category
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" href="{{route('home')}}#fashion">Fashion</a>
                              <a class="dropdown-item" href="{{route('home')}}#electronics">Electronics</a>
                              <a class="dropdown-item" href="{{route('home')}}#jewellery">Jewellery</a>
                          </div>
                      </div>

                      @auth
                          <a href="{{ route('my.orders') }}" class="btn btn-secondary">
                              My Orders
                          </a>
                      @endauth
                      <div class="main">
                          <!-- Another variation with a button -->
                          <div class="input-group">
                              <input type="text" class="form-control" placeholder="Search this blog">
                              <div class="input-group-append">
                                  <button class="btn btn-secondary" type="button" style="background-color: #f26522; border-color:#f26522 ">
                                      <i class="fa fa-search"></i>
                                  </button>
                              </div>
                          </div>
                      </div>

                      <div class="header_box">
                          <div class="login_menu">
                              <ul class="d-flex align-items-center">
                                  @auth
                                      {{-- Cart Button --}}
                                      @php
                                          $cartCount = \App\Models\CartItem::where('user_id', auth()->id())->sum('quantity');
                                      @endphp
                                      <li class="mr-2">
                                          <a href="{{ route('cart.view') }}" class="btn btn-info">
                                              <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                              Cart <span class="badge badge-pill badge-danger">{{ $cartCount }}</span>
                                          </a>
                                      </li>

                                      {{-- Logout Button --}}
                                      <li>
                                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                              @csrf
                                          </form>
                                          <a href="#" class="btn btn-dark"
                                             onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                              <i class="bi bi-box-arrow-right"></i>
                                              <span class="padding_10">Logout</span>
                                          </a>
                                      </li>
                                  @else
                                      {{-- Login Button --}}
                                      <li>
                                          <form id="login-form" action="{{ route('login') }}" method="GET" style="display: none;">
                                              @csrf
                                          </form>
                                          <a href="#" class="btn btn-dark"
                                             onclick="event.preventDefault(); document.getElementById('login-form').submit();">
                                              <i class="bi bi-box-arrow-right"></i>
                                              <span class="padding_10">Login</span>
                                          </a>
                                      </li>
                                  @endauth
                              </ul>
                          </div>

                      </div>

                  </div>
              </div>
          </div>
          <!-- header section end -->


         <!-- banner section start -->
          @include('frontend.layouts.banner')
         <!-- banner section end -->

      </div>
      <!-- banner bg main end -->

      <!-- fashion section start -->
      @if(session('success'))
          <div class="success-alert alert alert-success text-center"
               style="position: fixed; top: 20px; left: 50%; transform: translateX(-50%);
                z-index: 9999; width: auto; min-width: 300px;">
              {{ session('success') }}
          </div>
      @endif


      <div id="fashion" class="fashion_section">
          <div id="main_slider" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">

                  @foreach($fashionProducts->chunk(3) as $chunkIndex => $chunk)
                      <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                          <div class="container">
                              <h1 class="fashion_taital">Man & Woman Fashion</h1>
                              <div class="fashion_section_2">
                                  <div class="row">
                                      @foreach($chunk as $product)
                                          <div class="col-lg-4 col-sm-4">
                                              <div class="box_main">
                                                  <h4 class="shirt_text">{{ $product->name }}</h4>

                                 @if($product->on_sale)
                                 <p class="price_text">
                                    <span style="text-decoration: line-through; color: gray;">
                                        PKR {{ $product->price }}
                                    </span>
                                    <span style="color: red; font-weight: bold;">
                                      PKR {{ $product->sale_price }}</span>
                                    </p>
                                     @else
                                     <p class="price_text">
                                      Price <span style="color: #262626;">PKR {{ $product->price }}</span>
                                      </p>
                                     @endif

                                                  <div class="tshirt_img">
                                                      <img src="{{ asset('storage/'.$product->image) }}">
                                                  </div>

                                                  <div class="btn_main">
                                                      @if($product->quantity <= 0)
                                                          <button class="btn btn-secondary" disabled>Out of Stock</button>
                                                      @else
                                                          @if(auth()->check())
                                                              <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                                                  @csrf
                                                                  <div class="buy_bt">
                                                                      <button type="submit" class="btn btn-primary">Buy Now</button>
                                                                  </div>
                                                              </form>
                                                          @else
                                                              <a href="{{ route('login') }}" class="btn btn-warning">Login to Buy</a>
                                                          @endif
                                                      @endif

                                                      <div class="seemore_bt">
                                                          <a href="{{ route('products.show', ['id' => $product->id]) }}">See More</a>
                                                      </div>
                                                  </div>

                                              </div>
                                          </div>
                                      @endforeach
                                  </div>
                              </div>
                          </div>
                      </div>
                  @endforeach

              </div>

              <a class="carousel-control-prev" href="#main_slider" role="button" data-slide="prev">
                  <i class="fa fa-angle-left"></i>
              </a>
              <a class="carousel-control-next" href="#main_slider" role="button" data-slide="next">
                  <i class="fa fa-angle-right"></i>
              </a>
          </div>
      </div>
      <!-- fashion section end -->


      <!-- electronic section start -->

      @if(session('success'))
          <div class="success-alert alert alert-success text-center"
               style="position: fixed; top: 20px; left: 50%; transform: translateX(-50%);
                z-index: 9999; width: auto; min-width: 300px;">
              {{ session('success') }}
          </div>
      @endif


      <div id="electronics" class="fashion_section">
          <div id="electronic_main_slider" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                  @foreach($electronicProducts->chunk(3) as $chunkIndex => $chunk)
                      <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                          <div class="container">
                              <h1 class="fashion_taital">Electronic</h1>
                              <div class="fashion_section_2">
                                  <div class="row">
                                      @foreach($chunk as $product)
                                          <div class="col-lg-4 col-sm-4">
                                              <div class="box_main">
                                                  <h4 class="shirt_text">{{ $product->name }}</h4>
                                                  <p class="price_text">
                                                      Price <span style="color: #262626;">PKR {{ $product->price }}</span>
                                                  </p>
                                                  <div class="electronic_img">
                                                      <img src="{{ asset('storage/'.$product->image) }}">
                                                  </div>
                                                  <div class="btn_main">
                                                      @if($product->quantity <= 0)
                                                          <button class="btn btn-secondary" disabled>Out of Stock</button>
                                                      @else
                                                          @if(auth()->check())
                                                              <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                                                  @csrf
                                                                  <div class="buy_bt">
                                                                      <button type="submit" class="btn btn-primary">Buy Now</button>
                                                                  </div>
                                                              </form>
                                                          @else
                                                              <a href="{{ route('login') }}" class="btn btn-warning">Login to Buy</a>
                                                          @endif
                                                      @endif

                                                      <div class="seemore_bt">
                                                          <a href="{{ route('products.show', ['id' => $product->id]) }}">See More</a>
                                                      </div>
                                                  </div>
                                              </div>

                                              </div>
                                      @endforeach
                                  </div>
                              </div>
                          </div>
                      </div>
                  @endforeach
              </div>
              <a class="carousel-control-prev" href="#electronic_main_slider" role="button" data-slide="prev">
                  <i class="fa fa-angle-left"></i>
              </a>
              <a class="carousel-control-next" href="#electronic_main_slider" role="button" data-slide="next">
                  <i class="fa fa-angle-right"></i>
              </a>
          </div>
      </div>
      <!-- electronic section end -->

      <!-- jewellery  section start -->

      @if(session('success'))
          <div class="success-alert alert alert-success text-center"
               style="position: fixed; top: 20px; left: 50%; transform: translateX(-50%);
                z-index: 9999; width: auto; min-width: 300px;">
              {{ session('success') }}
          </div>
      @endif

      <div id="jewellery" class="fashion_section">
          <div id="jewellery_main_slider" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                  @foreach($jewelleryProducts->chunk(3) as $chunkIndex => $chunk)
                      <div class="carousel-item {{ $chunkIndex == 0 ? 'active' : '' }}">
                          <div class="container">
                              <h1 class="fashion_taital">Jewellery</h1>
                              <div class="fashion_section_2">
                                  <div class="row">
                                      @foreach($chunk as $product)
                                          <div class="col-lg-4 col-sm-4">
                                              <div class="box_main">
                                                  <h4 class="shirt_text">{{ $product->name }}</h4>
                                                  <p class="price_text">
                                                      Price <span style="color: #262626;">PKR {{ $product->price }}</span>
                                                  </p>
                                                  <div class="electronic_img">
                                                      <img src="{{ asset('storage/'.$product->image) }}">
                                                  </div>
                                                  <div class="btn_main">
                                                      @if($product->quantity <= 0)
                                                          <button class="btn btn-secondary" disabled>Out of Stock</button>
                                                      @else
                                                          @if(auth()->check())
                                                              <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                                                  @csrf
                                                                  <div class="buy_bt">
                                                                      <button type="submit" class="btn btn-primary">Buy Now</button>
                                                                  </div>
                                                              </form>
                                                          @else
                                                              <a href="{{ route('login') }}" class="btn btn-warning">Login to Buy</a>
                                                          @endif
                                                      @endif

                                                      <div class="seemore_bt">
                                                          <a href="{{ route('products.show', ['id' => $product->id]) }}">See More</a>
                                                      </div>
                                                  </div>

                                              </div>
                                          </div>
                                      @endforeach
                                  </div>
                              </div>
                          </div>
                      </div>
                  @endforeach
              </div>

              <!-- Corrected Arrows -->
              <a class="carousel-control-prev" href="#jewellery_main_slider" role="button" data-slide="prev">
                  <i class="fa fa-angle-left"></i>
              </a>
              <a class="carousel-control-next" href="#jewellery_main_slider" role="button" data-slide="next">
                  <i class="fa fa-angle-right"></i>
              </a>
          </div>
      </div>

      <!-- jewellery  section end -->

      <!-- footer section start -->
      @include('frontend.layouts.footer')
      <!-- footer section end -->


      <!-- Javascript files-->
      <script src="{{asset('frontend/js/jquery.min.js')}}"></script>
      <script src="{{asset('frontend/js/popper.min.js')}}"></script>
      <script src="{{asset('frontend/js/bootstrap.bundle.min.js')}}"></script>
      <script src="{{asset('frontend/js/jquery-3.0.0.min.js')}}"></script>
      <script src="{{asset('frontend/js/plugin.js')}}"></script>
      <!-- sidebar -->
      <script src="{{asset('frontend/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
      <script src="{{asset('frontend/js/custom.js')}}"></script>



      <script>
         function openNav() {
           document.getElementById("mySidenav").style.width = "250px";
         }

         function closeNav() {
           document.getElementById("mySidenav").style.width = "0";
         }
      </script>

{{--      <script>--}}
{{--          document.addEventListener('DOMContentLoaded', () => {--}}
{{--              const cartNav = document.querySelector('.cart-nav');--}}
{{--              const dropdown = cartNav.querySelector('.cart-dropdown');--}}
{{--              cartNav.addEventListener('mouseenter', () => dropdown.style.display = 'block');--}}
{{--              cartNav.addEventListener('mouseleave', () => dropdown.style.display = 'none');--}}
{{--          });--}}
{{--      </script>--}}

      <script>
          document.addEventListener('DOMContentLoaded', function() {
              setTimeout(function() {
                  document.querySelectorAll('.success-alert').forEach(function(alert) {
                      alert.style.display = 'none';
                  });
              }, 3000); // 3000 ms = 3 seconds
          });
      </script>



   </body>
</html>
