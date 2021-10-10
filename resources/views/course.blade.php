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
                      {{ Auth::user()->login }} <br>
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
          @if(Auth::check())
          @if(Auth::user()->is_Admin != 0)
          <li><a href="/main">Главная</a></li>    
          @else  
          <li><a href="/">Главная</a></li>
          @endif 
          @endif
          @if(Auth::check())
          <li><a href="{{route('Apartment')}}">Личный кабинет</a></li>      
          @endif       
        </ul>
        

        
      </div>  
      </div>
      
</nav><!-- END main menu -->
        
<!-- ######################## Header (featured posts) ######################## -->
     
<header>
       
<div class="row">

<article>
            
<div class="twelve columns">
<h1>{{ $course->name }}</h1>
<p class="excerpt">Начало курса: <b>{{ $course->time }}</b>.</p>    
<p class="excerpt">
Количество мест: <b>{{ $course->quantity }}</b></p>    
</div>      
 </article>
</div>
</header>
      
<!-- ######################## Section ######################## -->

<section class="section_light">
      <div class="row">
      <p> <img src="{{ asset('images/pin9.jpg') }}" alt="desc" width=300 align=left hspace=30> {{$course->description}}</p>
                           @if(Auth::check() && Auth::user()->is_Admin == 0)
                              @if(in_array($course->id,$x->course_id))
                               @if($course->time >\Illuminate\Support\Carbon::now())
                                  @if($course->time >\Illuminate\Support\Carbon::now()->addDay())
                                  <a href="{{route('deleteC',['userId'=>Auth::user()->id,'courseId'=>$course->id])}}">Отказаться от курса</a>
                                  @else
                                 <p><strong>Невозможно отказаться от курса</strong></p>
                                  @endif
                               @else
                               <p><strong>Невозможно отказаться от курса</strong></p>
                               @endif
                             @else
                               @if($course->quantity>0 && $course->time >\Illuminate\Support\Carbon::now())
                                  <a href="{{ route('subscribe',['Id'=>$course->id,'Name'=>$course->name]) }}">Записаться на курс</a>
                                 @else
                                <p><strong>Невозможно записаться на курс</strong></p>
                                @endif
                             @endif
                           @endif

            @if(Auth::check() && Auth::user()->is_Admin != 0)
            <section class="four columns" style="margin-left: 800px;margin-top: -200px;">
                <div class="panel">
                <h3></h3>
                <ul class="accordion">
                    <li class="active">
                    <div class="title">
                        <a href="/admin"><h5>Панель админа</h5></a>
                    </div>
                    </li>
                </ul>
                </div>
            </section>
            @endif
          </div>                 
      </div>
<!-- ######################## Section ######################## -->

   <section>
   
      <div class="section_dark" style="margin-top: 30px;">
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