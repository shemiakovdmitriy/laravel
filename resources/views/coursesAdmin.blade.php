<!DOCTYPE html>
<html class="no-js" lang="en">
<head>

  <meta charset="utf-8" />
  <!-- Set the viewport width to device width for mobile -->
  <meta name="viewport" content="width=device-width" />

  <title>Языковая школа LINGVO</title>
  
  <!-- Included CSS Files (Compressed) -->
  <link rel="stylesheet" href="{{ asset('stylesheets/foundation.min.css') }}">
  <link rel="stylesheet" href="{{ asset('stylesheets/main.css') }}">
  <link rel="stylesheet" href="{{ asset('stylesheets/app.css') }}">

  <script src="{{ asset('javascripts/modernizr.foundation.js') }}"></script>
  
  <link rel="stylesheet" href="{{ asset('fonts/ligature.css') }}">
  
  <!-- Google fonts -->
  <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300|Playfair+Display:400italic' rel='stylesheet' type='text/css' />

  <!-- IE Fix for HTML5 Tags -->
  <!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->

</head>

<body>

<!-- ######################## Main Menu ######################## -->
 
<nav>

     <div class="twelve columns header_nav">
      <div style="float:right; margin-right: 100px;">

          @if(Auth::check())
                      {{ Auth::user()->login }} 
          <a class="dropdown-item" href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Выход
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
          @else
          <a href="{{ route('login') }}">Логин</a> <br>
          <a href="{{ route('register') }}">Регистрация</a>
          @endif
        </div> 

        <div class="row">
      
        <ul id="menu-header" class="nav-bar horizontal">
        
          @if(Auth::user()->is_Admin != 0)
          <li><a href="/main">Главная</a></li>    
          @else  
          <li><a href="/">Главная</a></li>
          @endif 
          @if(Auth::check())
          <li><a href="{{route('Apartment',['id'=>Auth::user()->id])}}">Личный кабинет</a></li>      
          @endif 
        </ul>
        

        
      </div>  
      </div>
      
</nav><!-- END main menu -->
        
<!-- ######################## Header (featured posts) ######################## -->
     
<header>
   

        <div class="row">
        
        <h1>Записи на курсы</h1>
        
</header>
      
<!-- ######################## Section ######################## -->

<section>
<div class="section_main">
        <div class="row">
            <section class="eight columns">
              
        @foreach($courses as $course)
        <article class="blog_post">
        <div class="nine columns">
          <h4><strong>Курс: </strong>{{$course->name}}</h4>
          <strong>Кол-во мест: </strong>{{$course->quantity}},
          <strong>Кол-во записавшихся: </strong>{{$course->Count()}}
          
        </div>
        </article>
        @endforeach
            </section>
            
        </div>
    </div>
</section>


<!-- ######################## Section ######################## -->

   <section>
   
      <div class="section_dark">
      <div class="row"> 
      
      <h2></h2>
      
          <div class="two columns">
          <img src="{{ asset('images/thumb1.jpg') }}" alt="desc" />
          </div>
          
          <div class="two columns">
          <img src="{{ asset('images/thumb2.jpg') }}"  alt="desc" />
          </div>
          
          <div class="two columns">
          <img src="{{ asset('images/thumb3.jpg') }}"  alt="desc" />
          </div>
          
          <div class="two columns">
          <img src="{{ asset('images/thumb4.jpg') }}"  alt="desc" />
          </div>
          
          <div class="two columns">
          <img src="{{ asset('images/thumb5.jpg') }}"  alt="desc" />
          </div>
          
          <div class="two columns">
          <img src="{{ asset('images/thumb6.jpg') }}"  alt="desc" />
          </div>

      
      </div>
      </div>
      
    </section>


<!-- ######################## Footer ######################## -->  
      
<footer>

      <div class="row">
      
          <div class="twelve columns footer">
              <a href="" class="lsf-icon" style="font-size:16px; margin-right:15px" title="twitter">Twitter</a> 
              <a href="" class="lsf-icon" style="font-size:16px; margin-right:15px" title="facebook">Facebook</a>
              <a href="" class="lsf-icon" style="font-size:16px; margin-right:15px" title="pinterest">Pinterest</a>
              <a href="" class="lsf-icon" style="font-size:16px" title="instagram">Instagram</a>
          </div>
          
      </div>

</footer>		  

<!-- ######################## Scripts ######################## --> 

    <!-- Included JS Files (Compressed) -->
    <script src="{{ asset('javascripts/foundation.min.js') }}" type="text/javascript"></script> 
    <!-- Initialize JS Plugins -->
     <script src="{{ asset('javascripts/app.js') }}" type="text/javascript"></script>
</body>
</html>