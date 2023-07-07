<!DOCTYPE html>
<html>
<head>
  <title>Reservaciones y Comentarios</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <style>
    body {
      margin: 0;
      padding: 0;
    }
    .container {
      background-color: #007bff;
    }
    /* Estilos CSS para el navbar */
    .navbar {
      overflow: hidden;
      display: flex;
      justify-content: space-between;
      align-items: center;
      width: 100%;
      border-bottom: 2px solid #ccc;
      background-color: #007bff;
    }
    .text-dashborad{
      font-size: 15px;
      font-weight: bold;
      margin-bottom: 5px;
      text-align: unset;
    }
    .navbar a {
      display: inline-block;
      padding: 10px;
      text-decoration: none;
      font-family: 'Calibri';
      font-size: 20px;
      color: #fff;
    }

    .navbar a:hover {
      background-color: #699BFA;
    }

    .btn-right {
      display: flex;
      justify-content: flex-end;
    }

    /* Estilos CSS para las cajas */
    .grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 20px;
      padding: 20px;
    }

    .box {
      border: 2px solid #ccc;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      height: 100%;
    }

    .text-category {
      font-size: 15px;
      font-weight: bold;
      margin-bottom: 5px;
      text-align: unset;
    }

    table {
      border-collapse: collapse;
      width: 100%;      
    }

    th, td {
      border: 1px solid #ccc;
      padding: 8px;
      text-align: left;
    }

    th {
      font-weight: bold;
      background-color: #f2f2f2;
    }

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    /* Estilos adicionales para la tabla */
    table {
      border-radius: 10px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }

    th, td {
      border-radius: 10px;
    }
    .comment-container {
      margin-top: 20px;
      border: 2px solid #ccc;
      padding: 10px;
      border-radius: 10px;
      background-color: #f9f9f9;
    }

    .comment {
      margin-bottom: 10px;
    }
    .comment-t{
      font-weight: bold;
    }
  </style>
</head>
<body>
<div class="navbar">
    <a href="http://127.0.0.1:8000/">Inicio</a>
    <div>
      @if (Route::has('login'))
        @auth
          <a class="text-dashboard">{{ auth()->user()->name }}</a>
          <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-dashboard">Cerrar Sesión</a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
        @else
          <a href="{{ route('login') }}" class="text-dashboard">Iniciar Sesión</a>
          @if (Route::has('register'))
            <a href="{{ route('register') }}" class="text-dashboard">Registrarse</a>
          @endif
        @endauth
      @endif
    </div>    
</div>    
<h1 class="text-3xl font-bold text-center mb-4 mt-4">
    Reservaciones y Comentarios
</h1>
<H2 class="text-center">
  Antes de su publicación, los comentarios serán revisados y aprobados por un administrador.
</H2>
<div class="grid">
  <table>
    <thead>
      <tr>
        <th>Habitación</th>
        <th>Fecha de Entrada</th>
        <th>Fecha de Salida</th>
        <th>Precio Unitario</th>
        <th>Personas</th>   
        <th>Total</th>
      </tr>
    </thead>
    <tbody>
      @foreach($bokkings as $bokking)
      <tr>
        <td>{{ $bokking->room->category->name }}</td>
        <td>{{ date('d/m/Y', strtotime($bokking->entry)) }}</td>
        <td>{{ date('d/m/Y', strtotime($bokking->departure)) }}</td>
        <td>{{ $bokking->room->price }} bs.-</td>
        <td>{{ $bokking->amount }}</td>
        <td>{{ $bokking->costo }} bs.-</td>
      </tr>
      @endforeach
    </tbody>
    <div class="comment-container">
    <h2 class="comment-t">Comentarios:</h2>
    @foreach($comments as $comment)
      <div class="comment">
        <p>{{ $comment->comment }}</p>
      </div>
    @endforeach
  </div>
  </table>
</div>
</body>
</html>
