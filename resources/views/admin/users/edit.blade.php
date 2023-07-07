<x-app-layout>
    <h1 class="text-center font-semibold text-2xl my-8">Editar Usuario</h1>

    <div class="max-w-lg mx-auto my-8">
        <form action="{{ route('admin.users.update', $user->id) }}" method="post" autocomplete="off">
            @csrf
            @method('put')

            <x-input-error :messages="$errors->get('name')" class="mt-2" />
            <div class="mb-4">
                <label for="name" class="block font-medium text-sm text-gray-700 mb-2">Nombre</label>
                <input 
                    id="name"
                    name="name"
                    type="text"
                    value="{{ old('name', $user->name) }}"
                    class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Inserta un nombre"
                >
            </div>

            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            <div class="mb-4">
                <label for="phone" class="block font-medium text-sm text-gray-700 mb-2">Teléfono</label>
                <input 
                    id="phone"
                    name="phone"
                    type="text"
                    value="{{ old('phone', $user->phone) }}"
                    class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Inserta un teléfono"
                >
            </div>

            <x-input-error :messages="$errors->get('identity_card')" class="mt-2" />
            <div class="mb-4">
                <label for="identity_card" class="block font-medium text-sm text-gray-700 mb-2">Número de Identificación</label>
                <input 
                    id="identity_card"
                    name="identity_card"
                    type="number"
                    value="{{ old('identity_card', $user->identity_card) }}"
                    class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Inserta un número de identificación"
                >
            </div>

            <x-input-error :messages="$errors->get('email')" class="mt-2" />
            <div class="mb-4">
                <label for="email" class="block font-medium text-sm text-gray-700 mb-2">Correo Electrónico</label>
                <input 
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email', $user->email) }}"
                    class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Inserta un correo electrónico"
                >
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
            <div class="mb-4">
                <label for="password" class="block font-medium text-sm text-gray-700 mb-2">Contraseña</label>
                <input 
                    id="password"
                    name="password"
                    type="password"
                    class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Inserta una contraseña"
                >
            </div>

            <x-input-error :messages="$errors->get('user_type')" class="mt-2" />
            <div class="mb-4">
                <label for="user_type" class="block font-medium text-sm text-gray-700 mb-2">Tipo de Usuario</label>
                <select name="user_type" id="user_type" class="py-3 px-4 block w-full border-gray-200 rounded-md text-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="public" {{ old('user_type', $user->user_type) === 'public' ? 'selected' : '' }}>Public</option>
                    <option value="admin" {{ old('user_type', $user->user_type) === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="creator" {{ old('user_type', $user->user_type) === 'creator' ? 'selected' : '' }}>Creator</option>
                </select>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 text-sm text-gray-100 hover:text-white px-4 py-2 rounded mt-8">
                    Actualizar
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
