<!DOCTYPE html>
<html>
<head>
  <title>Proyecto de Hotel</title>
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
      width: 98.9vw;
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

    .box-title {
      font-size: 20px;
      font-weight: bold;
      margin-bottom: 5px;
      color: black;
    }

    .box-description {
      font-size: 13px;
      color: black;
    }

    .text-price {
      font-size: 18px;
      font-weight: bold;
      margin-bottom: 5px;
    }

    .text-category {
      font-size: 15px;
      font-weight: bold;
      margin-bottom: 5px;
      text-align: unset;
    }

    img {
      display: block;
      margin-left: auto;
      margin-right: auto;
      width: 100%;
      height: auto;
      border-radius: 10px;
    }
  </style>
</head>
<body>
<div class="container">
  <div class="navbar">
    <div>
      <a href="#" onclick="filterRooms('Todos')">Todos</a>
      <a href="#" onclick="filterRooms('Individual')">Individual</a>
      <a href="#" onclick="filterRooms('Ejecutiva')">Ejecutiva</a>
      <a href="#" onclick="filterRooms('Doble')">Doble</a>
      <a href="#" onclick="filterRooms('Familiar')">Familiar</a>
      <a href="#" onclick="filterRooms('Suite')">Suite</a>
    </div>

    <div>
      @if (Route::has('login'))
        @auth
          <a class="text-dashboard" style="cursor: default;">{{ auth()->user()->name }}</a>
          <a href="{{ route('showbokkings') }}">Reservaciones y Comentarios</a>
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
</div>

<div class="ax-w-3x1 mx-auto">
  <h1 class="text-3xl font-bold text-center mb-4 mt-4">
    Habitaciones
  </h1>

  <div class="grid">
    @foreach($images as $image)
    <div class="box hover:cursor-pointer" onclick="window.location.href='{{ route('image.rooms', $image->id) }}'" data-category="{{$image->room->category->name}}">
      <img class="rounded-lg mb-4" src="{{$image->path}}">
      <h2 class="box-title">{{$image->room->name}}</h2>
      <h3 class="text-category">Tipo de Habitacion: {{$image->room->category->name}}</h3>
      <p class="text-price">
        Precio: {{$image->room->price}}
      </p>
      <p class="box-description">
        Descripcion: {{ Str::limit($image->room->description, 70)}}
      </p>
      <p class="box-description">
        Ubicacion: {{ Str::limit($image->room->ubication, 100)}}
      </p>
    </div>
    @endforeach
  </div>
  <div>
    {{$images->links()}}
  </div>
</div>

<script>
  function filterRooms(category) {
    const boxes = document.querySelectorAll('.box');
    boxes.forEach((box) => {
      if (category === 'Todos' || box.getAttribute('data-category') === category) {
        box.style.display = 'block';
      } else {
        box.style.display = 'none';
      }
    });
  }
</script>
</body>
</html>
