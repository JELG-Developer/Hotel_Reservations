<x-app-layout>
    <div class="">
      <h1 class="title text-center font-semibold text-2xl mb-4">Lista de Usuarios Registrados</h1>
        {{-- Tabla --}}
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
              <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="overflow-hidden">
                  <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Teléfono</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Correo</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">CI</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tipo</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acciones</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($users as $user)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ $user->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800 whitespace-pre-wrap">{{ $user->phone }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800 whitespace-pre-wrap">{{ $user->email }}</td>
                                <td class="px-6 py-4 text-sm text-gray-800 whitespace-pre-wrap">{{ $user->identity_card }}</td>                                    
                                <td class="px-6 py-4 text-sm text-gray-800 whitespace-pre-wrap">{{ $user->user_type}}</td>          
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2 flex">
                                <a class="text-blue-500 hover:text-blue-700" href="{{ route('admin.users.edit', $user->id) }}">Editar</a>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="post">
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
        {{ $users->links() }}
    </div>
</x-app-layout>