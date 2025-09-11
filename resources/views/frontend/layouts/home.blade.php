<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
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

{{--                  <div id="mySidenav" class="sidenav">--}}
{{--                     <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>--}}
{{--                     <a href="index.html">Home</a>--}}
{{--                     <a href="fashion.html">Fashion</a>--}}
{{--                     <a href="electronic.html">Electronic</a>--}}
{{--                     <a href="jewellery.html">Jewellery</a>--}}
{{--                  </div>--}}
{{--                  <span class="toggle_icon" onclick="openNav()"><img src="{{asset('frontend/images/toggle-icon.png')}}"></span>--}}

                  <div class="dropdown">
                     <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">All Category
                     </button>
                     <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#">Fashion</a>
                        <a class="dropdown-item" href="#">Electronics</a>
                        <a class="dropdown-item" href="#">Jewellery</a>
                     </div>
                  </div>
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
{{--                     <div class="lang_box ">--}}
{{--                        <a href="#" title="Language" class="nav-link" data-toggle="dropdown" aria-expanded="true">--}}
{{--                        <img src="{{asset('frontend/images/flag-uk.png')}}" alt="flag" class="mr-2 " title="United Kingdom"> English <i class="fa fa-angle-down ml-2" aria-hidden="true"></i>--}}
{{--                        </a>--}}
{{--                        <div class="dropdown-menu ">--}}
{{--                           <a href="#" class="dropdown-item">--}}
{{--                           <img src="{{asset('frontend/images/flag-france.png')}}" class="mr-2" alt="flag">--}}
{{--                           French--}}
{{--                           </a>--}}
{{--                        </div>--}}
{{--                     </div>--}}
                     <div class="login_menu">
                        <ul>
                           <li><a href="#">
                              <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                              <span class="padding_10">Cart</span></a>
                           </li>

                            @auth
                            <li>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>

                                <a href="#" style="margin-left: 20px" class="btn btn-dark"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right"></i>
                                    <span class="padding_10">Logout</span>
                                </a>
                            </li>
                            @else

                            <li>
                                <form id="login-form" action="{{ route('login.post') }}" method="GET" style="display: none;">
                                    @csrf
                                </form>

                                <a href="#" style="margin-left: 20px" class="btn btn-dark"
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
      <div class="fashion_section">
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
                                                  <p class="price_text">
                                                      Price <span style="color: #262626;">PKR {{ $product->price }}</span>
                                                  </p>
                                                  <div class="tshirt_img">
                                                      <img src="{{ asset('storage/'.$product->image) }}">
                                                  </div>
                                                  <div class="btn_main">
                                                      <div class="buy_bt"><a href="#">Buy Now</a></div>
                                                      <div class="seemore_bt"><a href="{{route('products.show',['id' => $product->id])}}">See More</a></div>
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
      <div class="fashion_section">
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
                                                      <div class="buy_bt"><a href="#">Buy Now</a></div>
                                                      <div class="seemore_bt"><a href="#">See More</a></div>
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
      <div class="fashion_section">
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
                                                      <div class="buy_bt"><a href="#">Buy Now</a></div>
                                                      <div class="seemore_bt"><a href="#">See More</a></div>
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
   </body>
</html>
