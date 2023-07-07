<x-app-layout>
    <div class="">
        <h1 class="text-center font-semibold text-2xl">Lista de Categorías Registradas</h1>

        <div class="flex justify-end mb-8">
            <a href="{{ route('admin.categories.create') }}">
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
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Descripción</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                      </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($categories as $category)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ $category->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800 whitespace-pre-wrap">{{ $category->description  }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2 flex">
                                    <a class="text-blue-500 hover:text-blue-700" href="{{ route('admin.categories.edit', $category->id) }}">Editar</a>

                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="post">
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
</x-app-layout>