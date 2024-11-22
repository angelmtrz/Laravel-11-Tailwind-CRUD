<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ventas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white relative overflow-x-auto shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (count($sales) == 0)
                        <p>No hay ventas</p>
                    @else
                    <div class="flex justify-between items-center mb-2 p-2">
                        @if (count($sales) > 0)
                            <h4 class="mb-0 text-lg">Listado de Ventas</h4>
                        @endif
                        <form action="{{ route('sales.index') }}" method="GET" class="flex items-center">
                            <x-text-input name="search" class="flex-1" placeholder="RUC o Razón Social" value="{{ request('search') }}" />
                            <x-primary-button class="ms-1">
                                <i data-feather="search"></i>
                            </x-primary-button>
                        </form>
                        <x-primary-button-link href="{{ route('sales.create') }}">
                            <i data-feather="file-plus"></i>
                        </x-primary-button-link>
                    </div>
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                            <tr>
                                <th class="text-center py-3 px-6">#</th>
                                <th class="text-center py-3 px-6">Emisión</th>
                                <th class="text-center py-3 px-6">RUC Cliente</th>
                                <th class="text-center py-3 px-6">Razón Social Cliente</th>
                                <th class="text-center py-3 px-6">Total S/</th>
                                <th class="text-center py-3 px-6">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sales as $key => $sale)
                                <tr class="odd:bg-white even:bg-gray-100 border-b">
                                    <td class="py-3 px-6 text-center">{{ $key + 1 }}</td>
                                    <td class="font-medium py-3 px-6">{{ $sale->emission_date->format('d/m/Y H:i:s') }}</td>
                                    <td class="font-medium py-3 px-6 text-center">{{ $sale->customer->document }}</td>
                                    <td class="font-medium py-3 px-6 text-center">{{ $sale->customer->company_name }}</td>
                                    <td class="font-medium py-3 px-6 text-right">{{ number_format($sale->total, 2) }}</td>
                                    <td class="py-3 px-6 text-right">
                                        <x-primary-button-link href="{{ route('sales.show', $sale) }}">
                                            <i data-feather="info"></i>
                                        </x-primary-button-link>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- Paginación -->
                    <div class="mt-1">{{ $sales->links() }}</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
