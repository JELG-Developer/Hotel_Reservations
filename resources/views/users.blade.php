<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios Registrados</title>
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: sans-serif;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .container {
            border: solid 1px rgba(255, 255, 255, 0.2);
            margin-top: 30px;
            margin-left: 30px;
            margin-right: 30px;
        }

        table {
            color: #000; /* Cambiar el color del texto a negro */
            font-size: 14px;
            table-layout: fixed;
            border-collapse: collapse;
            width: auto; /* Ajustar al contenido */
        }

        thead {
            background: rgba(7, 35, 59, 0.4);
        }

        th {
            padding: 20px 15px;
            font-weight: 700;
            text-transform: uppercase;
            cursor: pointer; /* Agregar cursor de puntero solo a los títulos */
            user-select: none; /* Evitar la selección de texto */
            outline: none; /* Ocultar la línea de enfoque */
            color: #000; /* Cambiar el color del texto a negro */
        }

        td {
            padding: 15px;
            border-bottom: solid 1px rgba(255, 255, 255, 0.2);
            text-align: center; /* Alineación centrada */
        }

        tbody tr:hover {
            background: rgba(7, 35, 59, 0.4);
        }

        .truncate {
            max-width: 10ch;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .name-cell {
            width: 20%; /* Ajustar el ancho de la celda de nombres */
        }

        .titulo {
            margin-top: 20px;
            margin-bottom: 20px;
            text-align: center;
            font-size: 40px;
            font-weight: bold;
        }

        .reset-button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            text-align: center;
            font-weight: bold;
            cursor: pointer;
        }

        .search-input {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            width: 100%;
            max-width: 400px;
        }

    .pagination .page-item:last-child .page-link {
        margin-left: 1.5rem;
    }

    .pagination .page-link {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const headers = document.querySelectorAll('th'); // Obtener todos los encabezados

            headers.forEach(function(header) {
                header.addEventListener('click', function() {
                    const column = this.dataset.column; // Obtener el nombre de la columna
                    const order = this.dataset.order; // Obtener el orden actual

                    // Cambiar el orden
                    this.dataset.order = (order === 'asc') ? 'desc' : 'asc';

                    // Remover las clases de orden
                    headers.forEach(function(header) {
                        header.classList.remove('asc', 'desc');
                    });

                    // Aplicar la clase de orden
                    this.classList.add(order);

                    // Obtener todas las filas de la tabla
                    const tableBody = document.querySelector('tbody');
                    const rows = Array.from(tableBody.querySelectorAll('tr'));

                    // Ordenar las filas según el orden seleccionado
                    rows.sort(function(a, b) {
                        const aValue = a.querySelector(`td[data-column="${column}"]`).textContent;
                        const bValue = b.querySelector(`td[data-column="${column}"]`).textContent;

                        if (order === 'asc') {
                            return aValue.localeCompare(bValue);
                        } else {
                            return bValue.localeCompare(aValue);
                        }
                    });

                    // Volver a agregar las filas ordenadas a la tabla
                    rows.forEach(function(row) {
                        tableBody.appendChild(row);
                    });

                    console.log(`Orden actual: ${column} ${order}`);
                });
            });

            // Restablecer la página al estado principal
            const resetButton = document.querySelector('.reset-button');
            resetButton.addEventListener('click', function() {
                // Recargar la página
                location.reload();
            });

            // Búsqueda en tiempo real por nombre
            const searchInputName = document.querySelector('.search-input-name');
            searchInputName.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const tableBody = document.querySelector('tbody');
                const rows = Array.from(tableBody.querySelectorAll('tr'));

                rows.forEach(function(row) {
                    const nameCell = row.querySelector('.name-cell');
                    const name = nameCell.textContent.toLowerCase();

                    if (name.includes(searchTerm)) {
                        row.style.display = 'table-row';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });

            // Búsqueda en tiempo real por carnet de identidad
            const searchInputIdentityCard = document.querySelector('.search-input-identity-card');
            searchInputIdentityCard.addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                const tableBody = document.querySelector('tbody');
                const rows = Array.from(tableBody.querySelectorAll('tr'));

                rows.forEach(function(row) {
                    const identityCardCell = row.querySelector('.identity-card-cell');
                    const identityCard = identityCardCell.textContent.toLowerCase();

                    if (identityCard.includes(searchTerm)) {
                        row.style.display = 'table-row';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <h2 class="titulo">Lista de Usuarios</h2>
        <div class="search-inputs">
            <input type="text" class="search-input search-input-name" placeholder="Buscar por nombre">
            <input type="text" class="search-input search-input-identity-card" placeholder="Buscar por carnet de identidad">
        </div>
        <a href="#" class="reset-button">Restablecer</a>
        <table>
            <thead>
                <tr>
                    <th class="name-cell" data-column="name" data-order="asc">Nombre</th>
                    <th data-column="phone" data-order="asc">Teléfono</th>
                    <th class="identity-card-cell" data-column="identity_card" data-order="asc"><a href="#">CI</a></th>
                    <th data-column="email" data-order="asc">Correo</th>
                    <th data-column="user_type" data-order="asc"><a href="#">Tipo de usuario</a></th>
                    <th data-column="email_verified_at" data-order="asc">Fecha de verificación de correo</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $index => $user)
                    <tr>
                        <td class="truncate name-cell" data-column="name">{{ $user->name }}</td>
                        <td data-column="phone">{{ $user->phone }}</td>
                        <td class="identity-card-cell" data-column="identity_card">{{ $user->identity_card }}</td>
                        <td data-column="email">{{ $user->email }}</td>
                        <td data-column="user_type">{{ $user->user_type }}</td>
                        <td data-column="email_verified_at">{{ $user->email_verified_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
