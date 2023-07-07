<x-app-layout>
    <div class="">
        <h1 class="title text-center font-semibold text-2xl mb-4">Lista de Comentarios Registrados</h1>

        {{-- Tabla --}}
        <div class="flex flex-col">
            <div class="-m-1.5 overflow-x-auto">
              <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="overflow-hidden">
                  <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                      <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Usuario</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Comentario</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Reservacion</th>
                      </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach ($comments as $comment)
                            <tr>
                              <td class="px-6 py-4 text-sm text-gray-800 whitespace-pre-wrap">{{ $comment->bokking->user->name}}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">{{ Str::limit($comment->comment, 30) }}</td>                                
                                
                                            @if ($comment->status === 'visible')
                                            <td class="px-6 py-4 text-sm text-gray-800 whitespace-pre-wrap">Visible</td>
                                            @elseif ($comment->status === 'draft')
                                            <td class="px-6 py-4 text-sm text-gray-800 whitespace-pre-wrap">Borrador</td>
                                            @elseif ($comment->status === 'hidden')
                                            <td class="px-6 py-4 text-sm text-gray-800 whitespace-pre-wrap">Oculto</td>
                                            @endif
                                
                                <td class="px-6 py-4 text-sm text-gray-800 whitespace-pre-wrap">{{ $comment->bokking->room->category->name}}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2 flex">
                                <a class="text-blue-500 hover:text-blue-700" href="{{ route('admin.comments.edit', $comment->id) }}">Editar</a>
                                    <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="post">
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
        {{ $comments->links() }}
    </div>    
</x-app-layout>