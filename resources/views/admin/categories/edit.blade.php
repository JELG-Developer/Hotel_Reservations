<x-app-layout>
    <h1 class="text-center font-semibold text-2xl my-8">Editar Categoria</h1>

    <div class="max-w-lg mx-auto my-8">
        <form action="{{ route('admin.categories.update', $category->id) }}" method="post" autocomplete="off">
            @csrf
            @method('put')

            <x-input-error :messages="$errors->get('name')" class="mt-2" />
            <div class="mb-4">
                <label for="name" class="block font-medium text-sm text-gray-700 mb-2">Nombre</label>
                <input 
                    id="name"
                    name="name"
                    type="text"
                    value="{{ old('name', $category->name) }}"
                    class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Inserta un nombre"
                >
            </div>

            <x-input-error :messages="$errors->get('description')" class="mt-2" />
            <div class="mb-4">
                <label for="description" class="block font-medium text-sm text-gray-700 mb-2">Descripcion</label>
                <input 
                    id="description"
                    name="description"
                    type="text"
                    value="{{ old('description', $category->description) }}"
                    class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Inserta un descripcion"
                >
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-sm text-gray-100 hover:text-white px-4 py-2 rounded mt-8">
                    Actualizar
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
