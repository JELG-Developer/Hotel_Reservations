<x-app-layout>
    <h1 class="text-center font-semibold text-2xl my-8">Editar Comentario</h1>

    <div class="max-w-lg mx-auto my-8">
        <form action="{{ route('admin.comments.update', $comment->id) }}" method="post" autocomplete="off">
            @csrf
            @method('put')

            <x-input-error :messages="$errors->get('comment')" class="mt-2" />
            <div class="mb-4">
                <label for="comment" class="block font-medium text-sm text-gray-700 mb-2">Comentario</label>
                <textarea 
                    id="comment"
                    name="comment"
                    class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Inserta un comentario"
                >{{ old('comment', $comment->comment) }}</textarea>
            </div>

            <x-input-error :messages="$errors->get('status')" class="mt-2" />
            <div class="mb-4">
                <label for="status" class="block font-medium text-sm text-gray-700 mb-2">Estado</label>
                <select name="status" id="status" class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="visible" {{ old('status', $comment->status) === 'visible' ? 'selected' : '' }}>Visible</option>
                    <option value="draft" {{ old('status', $comment->status) === 'draft' ? 'selected' : '' }}>Borrador</option>
                    <option value="hidden" {{ old('status', $comment->status) === 'hidden' ? 'selected' : '' }}>Oculto</option>
                </select>
            </div>

            <x-input-error :messages="$errors->get('booking_id')" class="mt-2" />
            <div class="mb-4">

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-sm text-gray-100 hover:text-white px-4 py-2 rounded mt-8">
                    Actualizar
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
