<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ventas') }}
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
                                        <h4 class="mb-0 text-lg">Crear Nueva Venta</h4>
                                        <x-secondary-button-link href="{{ route('sales.index') }}">
                                            <i data-feather="chevrons-left"></i>
                                        </x-secondary-button-link>
                                    </div>
                                    <form id="sales_form" class="p-4 bg-gray-100" action="{{ route('sales.store') }}" method="POST">
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
                                            <label for="emission_date" class="block text-gray-700">Fecha</label>
                                            <input type="datetime-local" name="emission_date" id="emission_date" class="mt-1 block w-md-full p-2 border border-gray-300 rounded">
                                            <span class="text-red-600">{{ $errors->first('emission_date') }}</span>
                                        </div>
                                        <div class="mb-4">
                                            <label for="customer_id" class="block text-gray-700">Cliente</label>
                                            <select id="customer_id" name="customer_id" class="mt-1 block w-full p-2 border border-gray-300 rounded">
                                                <option value="" disabled selected>Seleccionar Cliente</option>
                                                @foreach ($customers as $customer)
                                                    <option value="{{ $customer->id }}">{{ $customer->document .' - '. Str::upper($customer->company_name) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-4">
                                            <label for="product_id" class="block text-gray-700">Productos</label>
                                            <select id="product_id" name="product_id" class="mt-1 block w-full p-2 border border-gray-300 rounded">
                                                <option value="" disabled selected>Seleccionar Productos</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}" data-code="{{ $product->code }}" data-name="{{ Str::upper($product->name) }}" data-price="{{ $product->price }}">{{ $product->code . ' - ' . Str::upper($product->name) . ' [Stock: '. number_format($product->stock) .']' }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="product_headers hidden">
                                            <div class="flex space-x-6">
                                                <div class="flex-1 w-1/2">
                                                    <label class="block w-full p-2 text-gray-700">Producto</label>
                                                </div>
                                                <div class="flex-1 w-1/4">
                                                    <label class="block w-full p-2 text-gray-700">Cantidad</label>
                                                </div>
                                                <div class="flex-1 w-1/4">
                                                    <label class="block w-full p-2 text-gray-700">Precio S/</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="product_container"></div>
                                        <span class="text-xs text-gray-500 product_message hidden">Para eliminar un producto, coloque su cantidad en cero (0)</span>
                                        <div class="mb-4 mt-4">
                                            <input type="hidden" name="items" id="items">
                                            <label for="total" class="block text-gray-700">Total de venta S/</label>
                                            <input type="number" name="total" id="total" min="0" step="0.01" class="mt-1 block w-md-full p-2 border border-gray-300 rounded" readonly>
                                            <span class="text-red-600">{{ $errors->first('total') }}</span>
                                        </div>
                                        <div class="flex justify-between items-center mb-2">
                                            <x-primary-button>{{ __('Registrar venta') }}</x-primary-button>
                                            <x-danger-button-link href="{{ route('sales.index') }}">{{ __('Cancelar') }}</x-danger-button-link>
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
    @vite(['resources/js/sales.js'])
</x-app-layout>
