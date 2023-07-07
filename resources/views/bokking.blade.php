<!DOCTYPE html>
<html>
<head>
    <title>Detalles de la Reserva</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Estilos CSS para el navbar */
        .navbar {
        overflow: hidden;
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 98.9vw;
        border-bottom: 1px solid #ccc;
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
        /* Estilos para la caja */
        .box {
            border: 1px solid #ccc;
            padding: 20px;
            margin-bottom: 20px;
        }

        /* Estilos para el título */
        h1 {
            font-size: 30px;
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
        }

        /* Estilos para los elementos de la caja */
        h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        p {
            margin-bottom: 5px;
        }

        form textarea {
            width: 100%;
            height: 150px;
            margin-bottom: 10px;
        }

        /* Estilos para el botón */
        input[type="submit"] {
            border-radius: 20px;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            cursor: pointer;
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
<h1>Detalles de la Reserva</h1>

<div class="box">
    <h2>Paquete {{ $bokking->room->name }}</h2>
    <p>Fecha de entrada: {{ $bokking->entry }}</p>
    <p>Fecha de salida: {{ $bokking->departure }}</p>
    <p>Cantidad de personas: {{ $bokking->amount }}</p>
    <p>Precio total: {{ $bokking->costo }}</p>
</div>

<div class="box">
    <h2>Agregar Comentario</h2>
    <form action="{{ route('bokking.addComment', $bokking->id) }}" method="POST">
        @csrf
        <textarea name="comment" placeholder="Escribe tu comentario aquí"></textarea>
        <br>
        <input type="submit" value="Agregar Comentario">
    </form>
</div>

</body>
</html>
