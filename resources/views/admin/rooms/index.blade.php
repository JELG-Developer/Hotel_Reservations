<x-app-layout>
    <div class="">
        <h1 class="text-center font-semibold text-2xl">Lista de Habitaciones Registradas</h1>

        <div class="flex justify-end mb-8">
            <a href="{{ route('admin.rooms.create') }}">
                <button class="bg-blue-500 text-sm text-gray-100 hover:text-white px-4 py-2 rounded">
                    Crear
                </button>
            </a>
        </div>

        {{-- Tabla --}}
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
              <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="overflow-hidden">
                  <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                      <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Paquete</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Descripción</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Precio Bs.-</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Numero de Habitación</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tipo</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ubicación</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                      </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($rooms as $room)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ $room->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800 whitespace-pre-wrap">{{ Str::limit($room->description, 30) }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800 whitespace-pre-wrap">{{ $room->price}}</td>
                                <td class="px-6 py-4 text-sm text-gray-800 whitespace-pre-wrap">{{ $room->number}}</td>
                                <td class="px-6 py-4 text-sm text-gray-800 whitespace-pre-wrap">{{ $room->status}}</td>
                                <td class="px-6 py-4 text-sm text-gray-800 whitespace-pre-wrap">{{ $room->category->name}}</td>
                                <td class="px-6 py-4 text-sm text-gray-800 whitespace-pre-wrap">{{ Str::limit($room->ubication, 30) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2 flex">
                                <a class="text-blue-500 hover:text-blue-700" href="{{ route('admin.rooms.edit', $room->id) }}">Editar</a>
                                    <form action="{{ route('admin.rooms.destroy', $room->id) }}" method="post">
                                        @method('delete')
                                        @csrf
                                        <button class="text-blue-500 hover:text-blue-700" type="submit">
                                          Eliminar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
    </div>
    <div class="mt-4">
        {{ $rooms->links() }}
    </div>    
</x-app-layout>