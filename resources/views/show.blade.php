<!DOCTYPE html>
<html>
<head>
    <title>Reserva de habitación</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>      
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
        /* Estilos para el título, descripción y ubicación */
        .title {
            font-size: 50px;
            font-weight: bold;
            margin-bottom: 40px;
            color: black;
            text-align: center; 
        }
        .first-word {
            font-weight: bold;            
        }
        .description {
            font-size: 13px;            
            margin-bottom: 20px;
            color: black;
        }
        .location{
            font-size: 20px;
            color: black;
            text-align: left; 
        }
        .divider {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
            color: black;
        }

        body {
            font-family: Arial, sans-serif;
        }

        .left-card {
            width: 100%;
            padding: 20px;
            margin-left: 40px;     
            border-radius: 10px;
            border: 2px solid #ccc;                             
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .right-card {
            width: 100%;
            padding: 20px;
            margin-left: auto;
            margin-right: 10px;
            border-radius: 10px;
            border: 2px solid #ccc;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: right;
        }
        
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .image {
            margin-top: -20px;
            margin-bottom: 20px;
        }

        .image img {
            max-width: 40%; 
            border-radius: 10px;
        }

        .category {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
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

        /* Estilos responsivos */
        @media screen and (min-width: 768px) {
            .container {
                flex-direction: row;
            }
            
            .left-card {
                width: 60%;
                margin-left: 40px;
                text-align: left;
            }
            .right-card {
                width: 35%;
                text-align: right;
                margin-left: auto;
                margin-right: 5px;
            }
        }
    </style>
    <script>
        function calcularTotal() {
            var precio = parseFloat(document.getElementById('price').value);
            var entrada = new Date(document.getElementById('entry').value);
            var salida = new Date(document.getElementById('departure').value);
            var dias = Math.ceil((salida.getTime() - entrada.getTime()) / (1000 * 60 * 60 * 24)) + 1;
            var total = precio * dias;

            document.getElementById('total').value = total.toFixed(2);
            document.getElementById('total-per-day').value = (total / dias).toFixed(2);
        }
    </script>
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
   Paquete: {{ $image->room->name }} 
</h1>
<center>
    <div class="container">
        <div class="left-card">
            <div class="left-box">
                <div class="space-x-2 mt-2 mb-8">
                </div>
                <div class="image">
                    <img src="{{ $image->path }}" alt="{{ $image->room->name }}">
                </div>                  
                <p class="location">
                    <span class="first-word">N°:  {{$image->room->number}} </span>
                </p> 
                <p class="location">
                    <span class="first-word">Tipo de Habitacion: {{ $image->room->category->name }} </span>
                </p>                                                                          
                <p class="location">
                    <span class="first-word">Ubicación: </span> {{ $image->room->ubication }}
                </p>  
                <p class="location">
                    <span class="first-word">Descripción: </span> {{ $image->room->description }}
                </p>  
                <p class="location">
                    <span class="first-word"> Precio: {{$image->room->price}} </span>
                </p>    
            </div>
        </div>
        <div class="right-card">
            <form action="{{ route('image.saveBokking', $image) }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">

                <label for="entry" style="text-align: left;" class="location">Fecha de entrada:</label>
                <input type="date" id="entry" name="entry" required onchange="calcularTotal()"><br><br>

                <label for="departure" style="text-align: left;" class="location">Fecha de salida:</label>
                <input type="date" id="departure" name="departure" required onchange="calcularTotal()"><br><br>

                <label for="amount" style="text-align: left;" class="location">Cantidad de personas:</label>
                <select id="amount" name="amount" required>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                </select><br><br>

                <input type="hidden" id="room_id" name="room_id" value="{{ $image->room->id }}">
                <input type="hidden" id="price" name="costo" value="{{$image->room->price}}">                

                <label for="paymenth_id" style="text-align: left;" class="location">Preció por día:</label>
                <input type="number" id="total-per-day" name="total-per-day" readonly><br><br>

                <label for="paymenth_id" style="text-align: left;" class="location">Total:</label>
                <input type="number" id="total" name="total" readonly required><br><br>

                <label for="paymenth_id" style="text-align: left;" class="location">Tipo de pago:</label>
                <select id="paymenth_id" name="paymenth_id" required>
                    <option value="1">Débito</option>
                    <option value="2">Crédito</option>
                </select>

                <input type="submit" value="Reservar">
            </form>
        </div>
    </div>
</center> 
</body>
</html>
