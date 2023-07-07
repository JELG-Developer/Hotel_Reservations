<x-app-layout>
    <div class="">
    <h1 class="title text-center font-semibold text-2xl mb-4">Lista de Reservaciones Registradas</h1>

        {{-- Tabla --}}
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
              <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="overflow-hidden">
                  <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                      <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Usuario</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fecha de Entrada</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fecha de Salida</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Habitación</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Precio U.</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Personas</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                      </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($bokkings as $bokking)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ $bokking->user->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800 whitespace-pre-wrap">{{ $bokking->entry  }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800 whitespace-pre-wrap">{{ $bokking->departure  }}</td>                                
                                <td class="px-6 py-4 text-sm text-gray-800 whitespace-pre-wrap">{{ $bokking->room->category->name  }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800 whitespace-pre-wrap">{{ $bokking->room->price  }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800 whitespace-pre-wrap">{{ $bokking->amount  }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800 whitespace-pre-wrap">{{ $bokking->costo  }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2 flex">
                                    <a class="text-blue-500 hover:text-blue-700" href="{{ route('admin.bokkings.edit', $bokking->id) }}">Editar</a>

                                    <form action="{{ route('admin.bokkings.destroy', $bokking->id) }}" method="post">
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
        {{ $bokkings->links() }}
    </div>        
</x-app-layout>