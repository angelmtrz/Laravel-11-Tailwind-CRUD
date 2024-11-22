<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ventas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 text-gray-900">
                <div class="overflow-x-auto">
                    <div class="container mx-auto my-5">
                        <div class="flex justify-center">
                            <div class="w-full max-w-full">
                                <div class="mt-3 rounded-lg shadow-lg overflow-hidden p-6 bg-white">
                                    <div class="flex justify-between items-center mb-2">
                                        <h4 class="mb-0 text-lg">Detalle de la venta</h4>
                                        <x-secondary-button-link href="{{ route('sales.index') }}">
                                            <i data-feather="chevrons-left"></i>
                                        </x-secondary-button-link>
                                    </div>
                                    <div class="p-4">
                                        <h5 class="text-lg font-bold uppercase">{{ $sale->customer->document }} - {{ $sale->customer->company_name }}</h5>
                                        <p class="mt-2 text-gray-700">Fecha de emisión: {{ $sale->emission_date->format('d/m/Y H:i:s') }}</p>
                                        <p class="mt-2 font-semibold">Total de la venta: S/ {{ number_format($sale->total, 2) }}</p>
                                        @if ($sale->items)
                                        <table class="w-full mt-4 text-sm text-left text-gray-500">
                                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                                <tr>
                                                    <th class="text-center py-3 px-6">#</th>
                                                    <th class="text-center py-3 px-6">Código</th>
                                                    <th class="text-center py-3 px-6">Producto</th>
                                                    <th class="text-center py-3 px-6">Cantidad</th>
                                                    <th class="text-center py-3 px-6">Precio Unitario</th>
                                                    <th class="text-center py-3 px-6">Total item</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach (json_decode($sale->items) as $key => $item)
                                                <tr class="odd:bg-white even:bg-gray-100 border-b">
                                                    <td class="py-3 px-6 text-center">{{ $key + 1 }}</td>
                                                    <td class="font-medium py-3 px-6 text-center">{{ $item->code }}</td>
                                                    <td class="font-medium py-3 px-6">{{ Str::upper($item->name) }}</td>
                                                    <td class="font-medium py-3 px-6 text-center">{{ $item->quantity }}</td>
                                                    <td class="font-medium py-3 px-6 text-right">{{ number_format($item->price, 2) }}</td>
                                                    <td class="font-medium py-3 px-6 text-right">{{ number_format($item->total_item, 2) }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
