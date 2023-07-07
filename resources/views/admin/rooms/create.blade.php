<x-app-layout>
    <h1 class="text-center font-semibold text-2xl my-8">Crear Nueva Habitación</h1>

    <div class="max-w-lg mx-auto my-8">
        <form action="{{ route('admin.rooms.store') }}" method="post" autocomplete="off">
            @csrf

            <x-input-error :messages="$errors->get('name')" class="mt-2" />
            <div class="mb-4">
                <label for="name" class="block font-medium text-sm text-gray-700 mb-2">Nombre</label>
                <input 
                    id="name"
                    name="name"
                    type="text"
                    value="{{ old('name') }}"
                    class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Inserta un nombre"
                >
            </div>

            <x-input-error :messages="$errors->get('description')" class="mt-2" />
            <div class="mb-4">
                <label for="description" class="block font-medium text-sm text-gray-700 mb-2">Descripción</label>
                <textarea 
                    id="description"
                    name="description"
                    class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Inserta una descripción"
                >{{ old('description') }}</textarea>
            </div>

            <x-input-error :messages="$errors->get('price')" class="mt-2" />
            <div class="mb-4">
                <label for="price" class="block font-medium text-sm text-gray-700 mb-2">Precio</label>
                <input 
                    id="price"
                    name="price"
                    type="number"
                    value="{{ old('price') }}"
                    class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Inserta el precio"
                >
            </div>

            <x-input-error :messages="$errors->get('number')" class="mt-2" />
            <div class="mb-4">
                <label for="number" class="block font-medium text-sm text-gray-700 mb-2">Número</label>
                <input 
                    id="number"
                    name="number"
                    type="text"
                    value="{{ old('number') }}"
                    class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Inserta el número"
                >
            </div>

            <x-input-error :messages="$errors->get('status')" class="mt-2" />
            <div class="mb-4">
                <label for="status" class="block font-medium text-sm text-gray-700 mb-2">Estado</label>
                <select name="status" id="status" class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="disponible" {{ old('status') === 'disponible' ? 'selected' : '' }}>Disponible</option>
                    <option value="ocupada" {{ old('status') === 'ocupada' ? 'selected' : '' }}>Ocupada</option>
                    <option value="limpieza" {{ old('status') === 'limpieza' ? 'selected' : '' }}>Limpieza</option>
                    <option value="mantenimiento" {{ old('status') === 'mantenimiento' ? 'selected' : '' }}>Mantenimiento</option>
                </select>
            </div>

            <x-input-error :messages="$errors->get('ubication')" class="mt-2" />
            <div class="mb-4">
                <label for="ubication" class="block font-medium text-sm text-gray-700 mb-2">Ubicación</label>
                <input 
                    id="ubication"
                    name="ubication"
                    type="text"
                    value="{{ old('ubication') }}"
                    class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Inserta la ubicación"
                >
            </div>

            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
            <div class="mb-4">
                <label for="category_id" class="block font-medium text-sm text-gray-700 mb-2">Categoría</label>
                <select name="category_id" id="category_id" class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-sm text-gray-100 hover:text-white px-4 py-2 rounded mt-8">
                    Crear
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
