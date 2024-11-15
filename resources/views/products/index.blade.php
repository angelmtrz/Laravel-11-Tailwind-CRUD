<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Productos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white relative overflow-x-auto shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (count($products) == 0)
                        <p>No hay productos</p>
                    @else
                    <div class="flex justify-between items-center mb-2 p-2">
                        @if (count($products) > 0)
                            <h4 class="mb-0 text-lg">Lista de Productos</h4>
                        @endif
                        <form action="{{ route('products.index') }}" method="GET" class="flex items-center">
                            <x-text-input name="search" class="flex-1" placeholder="Código o Nombre" value="{{ request('search') }}" />
                            <x-primary-button class="ms-1">
                                <i data-feather="search"></i>
                            </x-primary-button>
                        </form>
                        <x-primary-button-link href="{{ route('products.create') }}">
                            <i data-feather="file-plus"></i>
                        </x-primary-button-link>
                    </div>
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="text-center py-3 px-6">#</th>
                                <th class="text-center py-3 px-6">Código</th>
                                <th class="text-center py-3 px-6">Nombre</th>
                                <th class="text-center py-3 px-6">Stock</th>
                                <th class="text-center py-3 px-6">Precio S/</th>
                                <th class="text-center py-3 px-6">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $key => $product)
                                <tr class="odd:bg-white even:bg-gray-100 border-b">
                                    <td class="py-3 px-6 text-center">{{ $key + 1 }}</td>
                                    <td class="font-medium py-3 px-6">{{ $product->code }}</td>
                                    <td class="font-medium py-3 px-6">{{ Str::upper($product->name) }}</td>
                                    <td class="font-medium py-3 px-6 text-center">{{ $product->stock }}</td>
                                    <td class="font-medium py-3 px-6 text-right">{{ $product->price }}</td>
                                    <td class="py-3 px-6 text-right">
                                        <x-primary-button-link href="{{ route('products.show', $product) }}">
                                            <i data-feather="info"></i>
                                        </x-primary-button-link>
                                        <x-primary-button-link href="{{ route('products.edit', $product) }}">
                                            <i data-feather="edit"></i>
                                        </x-primary-button-link>
                                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <x-primary-button type="button" class="ms-1" onclick="confirmDelete(this.form)">
                                                <i data-feather="trash-2"></i>
                                            </x-primary-button>
                                        </form>
                                        <script>
                                            function confirmDelete(form) {
                                                Swal.fire({
                                                    title: '¿Estás seguro?',
                                                    text: 'No podrás revertir esto!',
                                                    icon: 'warning',
                                                    showCancelButton: true,
                                                    confirmButtonText: 'Sí, eliminar',
                                                    cancelButtonText: 'Cancelar'
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        form.submit();
                                                    }
                                                });
                                            }
                                        </script>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Paginación -->
                    <div class="mt-1">{{ $products->links() }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
