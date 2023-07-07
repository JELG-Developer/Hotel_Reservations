<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Habitaciones</title>
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
            font-weight: Normal;
        }

        .container {
            border: solid 1px rgba(255, 255, 255, 0.2);
            margin-top: 30px;
            margin-left: 30px;
            margin-right: 30px;
        }

        table {
            color: #000;
            /* Cambiar el color del texto a negro */
            font-size: 14px;
            table-layout: fixed;
            border-collapse: collapse;
            width: auto;
            /* Ajustar al contenido */
        }

        thead {
            background: rgba(7, 35, 59, 0.4);
        }

        th {
            padding: 20px 15px;
            font-weight: 700;
            text-transform: uppercase;
            cursor: pointer;
            /* Agregar cursor de puntero solo a los títulos */
            user-select: none;
            /* Evitar la selección de texto */
            outline: none;
            /* Ocultar la línea de enfoque */
            color: #000;
            /* Cambiar el color del texto a negro */
        }

        td {
            padding: 15px;
            border-bottom: solid 1px rgba(255, 255, 255, 0.2);
            text-align: center;
            /* Alineación centrada */
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
        document.addEventListener('DOMContentLoaded', function () {
            const rows = Array.from(document.querySelectorAll('tbody tr'));

            function sortRows(column, order) {
                const sortedRows = rows.sort(function (a, b) {
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

                sortedRows.forEach(function (row) {
                    row.parentElement.appendChild(row); // Mover las filas ordenadas al final del padre
                });
            }

            const headers = document.querySelectorAll('th');

            headers.forEach(function (header) {
                header.addEventListener('click', function () {
                    const column = this.dataset.column;
                    const order = this.dataset.order;

                    this.dataset.order = (order === 'asc') ? 'desc' : 'asc';

                    headers.forEach(function (header) {
                        header.classList.remove('asc', 'desc');
                    });

                    this.classList.add(order);

                    sortRows(column, order);
                });
            });

            const numberSearchInput = document.getElementById('numberSearchInput');
            const descriptionSearchInput = document.getElementById('descriptionSearchInput');
            const tableRows = Array.from(document.querySelectorAll('tbody tr'));

            numberSearchInput.addEventListener('input', function () {
                filterRows();
            });

            descriptionSearchInput.addEventListener('input', function () {
                filterRows();
            });

            function filterRows() {
                const numberSearchValue = numberSearchInput.value.toLowerCase().trim();
                const descriptionSearchValue = descriptionSearchInput.value.toLowerCase().trim();

                tableRows.forEach(function (row) {
                    const numberCell = row.querySelector('td[data-column="number"]');
                    const numberCellValue = numberCell.textContent.toLowerCase();

                    const descriptionCell = row.querySelector('td[data-column="description"]');
                    const descriptionCellValue = descriptionCell.textContent.toLowerCase();

                    const numberMatch = numberCellValue.includes(numberSearchValue);
                    const descriptionMatch = descriptionCellValue.includes(descriptionSearchValue);

                    if (numberMatch && descriptionMatch) {
                        row.style.display = '';
                    } else {
                        row.style.display = 'none';
                    }
                });
            }
        });
    </script>
</head>

<body>
    <div class="container">
        <h2 class="titulo">Lista de Habitaciones</h2>

        <!-- Agregar los campos de búsqueda -->
        <input type="text" id="numberSearchInput" class="search-input" placeholder="Buscar por Número de Habitación">
        <input type="text" id="descriptionSearchInput" class="search-input" placeholder="Buscar por Descripción">

        <table>
            <thead>
                <tr>
                    <th class="room-cell" data-column="room_id" data-order="asc">Paquete</th>
                    <th class="room-cell" data-column="number" data-order="asc">Número</th>
                    <th class="booking-cell" data-column="user_id" data-order="asc">Habitación</th>
                    <th class="comment-cell" data-column="description" data-order="asc">Descripción</th>
                    <th class="status-cell" data-column="status" data-order="asc">Precio</th>
                    <th class="room-cell" data-column="ubicacion" data-order="asc">Ubicación</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rooms as $room)
                <tr>
                    <td data-column="room_id">{{ $room->name }}</td>
                    <td data-column="number">{{ $room->number }}</td>
                    <td data-column="user_id">{{ $room->category->name }}</td>
                    <td data-column="description">{{ Str::limit($room->description, 50) }}</td>
                    <td data-column="status">{{ $room->price }} bs.-</td>
                    <td data-column="ubicacion">{{ Str::limit($room->ubication, 50) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
