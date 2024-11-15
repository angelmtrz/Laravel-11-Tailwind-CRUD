<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clientes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white relative overflow-x-auto shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (count($customers) == 0)
                        <p>No hay clientes</p>
                    @else
                    <div class="flex justify-between items-center mb-2 p-2">
                        @if (count($customers) > 0)
                            <h4 class="mb-0 text-lg">Lista de Clientes</h4>
                        @endif
                        <form action="{{ route('customers.index') }}" method="GET" class="flex items-center">
                            <x-text-input name="search" class="flex-1" placeholder="Documento o Razón Social" value="{{ request('search') }}" />
                            <x-primary-button class="ms-1">
                                <i data-feather="search"></i>
                            </x-primary-button>
                        </form>
                        <x-primary-button-link href="{{ route('customers.create') }}">
                            <i data-feather="file-plus"></i>
                        </x-primary-button-link>
                    </div>
                    @if (session('error'))
                        <div class="mb-4 p-4 bg-red-100 text-red-700 border border-red-400 rounded">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 border border-green-400 rounded">
                            {{ session('success') }}
                        </div>
                    @endif
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="text-center py-3 px-6">#</th>
                                <th class="text-center py-3 px-6">Tipo</th>
                                <th class="text-center py-3 px-6">Documento</th>
                                <th class="text-center py-3 px-6">Razón Social</th>
                                <th class="text-center py-3 px-6">Telefono</th>
                                <th class="text-center py-3 px-6">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $key => $customer)
                                <tr class="odd:bg-white even:bg-gray-100 border-b">
                                    <td class="py-3 px-6 text-center">{{ $key + 1 }}</td>
                                    <td class="font-medium py-3 px-6">{{ Str::ucfirst($customer->type) }}</td>
                                    <td class="font-medium py-3 px-6 text-center">{{ $customer->document }}</td>
                                    <td class="font-medium py-3 px-6 text-truncate">{{ Str::upper($customer->company_name) }}</td>
                                    <td class="font-medium py-3 px-6 text-center">{{ $customer->phone }}</td>
                                    <td class="py-3 px-6 text-right">
                                        <x-primary-button-link href="{{ route('customers.show', $customer) }}">
                                            <i data-feather="info"></i>
                                        </x-primary-button-link>
                                        <x-primary-button-link href="{{ route('customers.edit', $customer) }}">
                                            <i data-feather="edit"></i>
                                        </x-primary-button-link>
                                        <form action="{{ route('customers.destroy', $customer) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <x-primary-button type="button" onclick="confirmDelete(this.form)">
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
                    <div class="mt-1">{{ $customers->links() }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
