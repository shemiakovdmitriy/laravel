<!DOCTYPE html>
<html class="no-js" lang="en">
<head>

  <meta charset="utf-8" />
  <!-- Set the viewport width to device width for mobile -->
  <meta name="viewport" content="width=device-width" />

  <title>Админ-панель</title>
  
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
@if(count($errors)>0)
<div ><ul>
@foreach ($errors->all() as $error)
<li>{{$error}}</li>
@endforeach
</ul></div>
@endif
<h3 style="margin-left:100px">Показать данные о курсе</h3>
<form style="width:400px" method="get" action="/api/show">
<p>ID: <input type="number" name="id">
<button type="submit">Показать</button>
{{ csrf_field() }}
</form>
<h3 style="margin-left:100px">Добавление курса</h3>
<form style="width:400px" method="POST" action="/api/new">
<p>Название: <input type="text" name="name">
<p>Описание: <textarea name="description"></textarea>
<p>Кол-во мест: <input  type="number" name="quantity">
<p>Дата начала: <input type="datetime-local" name="time" value="2020-10-20T00:00">
<p><button type="submit">Добавить</button>
{{ csrf_field() }}
</form>
<br>
<h3 style="margin-left:100px">Удаление курса</h3>
<form style="width:400px" method="POST" action="/api/delete">
<p>ID:<br> <input type="number" name="id">
<input type=hidden name="_method" value="DELETE">
<p><button type="submit" >Удалить</button>
{{ csrf_field() }}
</form>
<br>
<h3 style="margin-left:100px">Изменение курса</h3>
<form style="width:400px" method="POST" action="{{route('showCourse')}}">
<p>ID:<br> <input type="number"  name="id" value="{{$course->id}}">
<p><button type="submit">Показать</button>
{{ csrf_field() }}
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
    <script src="javascripts/foundation.min.js" type="text/javascript"></script> 
    <!-- Initialize JS Plugins -->
     <script src="javascripts/app.js" type="text/javascript"></script>
</body>
</html>
