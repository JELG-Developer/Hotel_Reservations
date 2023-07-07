<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Comentarios</title>
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
        .titulo {
            margin-top: 20px;
            margin-bottom: 20px;
            text-align: center;
            font-size: 40px;
            font-weight: bold;
        }
        .subtitulo {
            margin-top: 20px;
            margin-bottom: 20px;
            text-align: center;
            font-size: 24px;
            font-weight: Normal ;
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

        .search-input {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            width: 100%;
            max-width: 400px;
        }

        .truncate {
            max-width: 10ch;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .date-cell {
            width: 15%;
        }

        .name-cell {
            width: 20%;
        }

        .payment-cell {
            width: 15%;
        }

        .amount-cell {
            width: 10%;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const rows = Array.from(document.querySelectorAll('tbody tr'));

            function sortRows(column, order) {
                const sortedRows = rows.sort(function(a, b) {
                    let aValue, bValue;

                    if (column === 'individual_name') {
                        aValue = parseInt(a.querySelector(`td[data-column="${column}"]`).textContent.trim());
                        bValue = parseInt(b.querySelector(`td[data-column="${column}"]`).textContent.trim());
                    } else {
                        aValue = a.querySelector(`td[data-column="${column}"]`).textContent.trim();
                        bValue = b.querySelector(`td[data-column="${column}"]`).textContent.trim();
                    }

                    if (order === 'asc') {
                        return aValue.localeCompare(bValue);
                    } else {
                        return bValue.localeCompare(aValue);
                    }
                });

                sortedRows.forEach(function(row) {
                    row.parentElement.appendChild(row); // Mover las filas ordenadas al final del padre
                });
            }

            const headers = document.querySelectorAll('th');

            headers.forEach(function(header) {
                header.addEventListener('click', function() {
                    const column = this.dataset.column;
                    const order = this.dataset.order;

                    this.dataset.order = (order === 'asc') ? 'desc' : 'asc';

                    headers.forEach(function(header) {
                        header.classList.remove('asc', 'desc');
                    });

                    this.classList.add(order);

                    sortRows(column, order);
                });
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <h2 class="titulo">Lista de Comentarios</h2>
        
        <!-- Agregar los campos de búsqueda -->
        <input type="text" id="nameSearchInput" class="search-input" placeholder="Buscar por nombre de usuario">
        <select id="statusSearchInput" class="search-input">
            <option value="">Buscar por estado</option>
            <option value="visible">Visible</option>
            <option value="draft">Draft</option>
            <option value="hidden">Hidden</option>
        </select>

        <table>
            <thead>
                <tr>
                    <th class="booking-cell" data-column="user_id" data-order="asc">Usuario</th>
                    <th class="comment-cell" data-column="comment" data-order="asc">Comentario</th>
                    <th class="status-cell" data-column="status" data-order="asc">Estado</th>
                    <th class="room-cell" data-column="room_id" data-order="asc">Habitacion</th>
                </tr>
            </thead>
            <tbody>
                @foreach($comments as $comment)
                    <tr>
                        <td data-column="user_id">{{ $comment->bokking->user->name }}</td>
                        <td data-column="comment">{{ $comment->comment }}</td>
                        <td data-column="status">{{ ucfirst($comment->status) }}</td>
                        <td data-column="room_id">{{ $comment->bokking->room->category->name}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        const nameSearchInput = document.getElementById('nameSearchInput');
        const statusSearchInput = document.getElementById('statusSearchInput');
        const tableRows = Array.from(document.querySelectorAll('tbody tr'));

        nameSearchInput.addEventListener('input', function() {
            filterRows();
        });

        statusSearchInput.addEventListener('change', function() {
            filterRows();
        });

        function filterRows() {
            const nameSearchValue = nameSearchInput.value.toLowerCase().trim();
            const statusSearchValue = statusSearchInput.value.toLowerCase().trim();

            tableRows.forEach(function(row) {
                const nameCell = row.querySelector('td[data-column="user_id"]');
                const nameCellValue = nameCell.textContent.toLowerCase();

                const statusCell = row.querySelector('td[data-column="status"]');
                const statusCellValue = statusCell.textContent.toLowerCase();

                const nameMatch = nameCellValue.includes(nameSearchValue);
                const statusMatch = statusSearchValue === '' || statusCellValue.includes(statusSearchValue);

                if (nameMatch && statusMatch) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>
</body>
</html>