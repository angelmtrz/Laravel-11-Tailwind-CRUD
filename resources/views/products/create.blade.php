<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Productos') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 text-gray-900">
                <div class="overflow-x-auto">
                    <div class="container mx-auto my-5">
                        <div class="flex justify-center">
                            <div class="w-full max-w-3xl">
                                <div class="mt-3 rounded-lg shadow-lg overflow-hidden p-6 bg-white">
                                    <div class="flex justify-between items-center mb-2">
                                        <h4 class="mb-0 text-lg">Crear Nuevo Producto</h4>
                                        <x-secondary-button-link href="{{ route('products.index') }}">
                                            <i data-feather="chevrons-left"></i>
                                        </x-secondary-button-link>
                                    </div>
                                    <form class="p-4 bg-gray-100" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @if ($errors->any())
                                            <div class="mb-4 p-4 text-red-600 bg-red-100 border border-red-300 rounded">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <div class="mb-4">
                                            <label for="code" class="block text-gray-700">Código</label>
                                            <input type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded" name="code" maxlength="10" placeholder="Código del producto">
                                            <span class="text-red-600">{{ $errors->first('code') }}</span>
                                        </div>
                                        <div class="mb-4">
                                            <label for="name" class="block text-gray-700">Nombre</label>
                                            <input type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded" name="name" maxlength="100" placeholder="Nombre del Producto">
                                            <span class="text-red-600">{{ $errors->first('name') }}</span>
                                        </div>
                                        <div class="mb-4">
                                            <label for="description" class="block text-gray-700">Descripción</label>
                                            <textarea class="mt-1 block w-full p-2 border border-gray-300 rounded" name="description" maxlength="300" placeholder="Descripción del producto"></textarea>
                                            <span class="text-red-600">{{ $errors->first('description') }}</span>
                                        </div>
                                        <div class="mb-4">
                                            <label for="stock" class="block text-gray-700">Stock</label>
                                            <input type="number" class="mt-1 block w-full p-2 border border-gray-300 rounded" name="stock" min="0" step="1">
                                            <span class="text-red-600">{{ $errors->first('stock') }}</span>
                                        </div>
                                        <div class="mb-4">
                                            <label for="price" class="block text-gray-700">Precio S/</label>
                                            <input type="number" class="mt-1 block w-full p-2 border border-gray-300 rounded" name="price" step="0.01">
                                            <span class="text-red-600">{{ $errors->first('price') }}</span>
                                        </div>
                                        <div class="mb-4">
                                            <label for="image" class="block text-gray-700">Imagen</label>
                                            <input type="file" accept="image/png, image/jpeg" class="mt-1 block w-full p-2 border border-gray-300 rounded" name="image">
                                            <span class="text-xs">Formatos permitidos: png, jpeg - Tamaño máximo: 2MB</span>
                                            <span class="text-red-600">{{ $errors->first('image') }}</span>
                                        </div>
                                        <div class="flex justify-between items-center mb-2">
                                            <x-primary-button>{{ __('Registrar') }}</x-primary-button>
                                            <x-danger-button-link href="{{ route('products.index') }}">{{ __('Cancelar') }}</x-danger-button-link>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
