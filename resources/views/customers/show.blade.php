<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clientes') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 text-gray-900">
                <div class="overflow-x-auto">
                    <div class="container mx-auto my-5">
                        <div class="flex justify-center">
                            <div class="w-full max-w-md">
                                <div class="max-w-sm mx-auto bg-white rounded-lg shadow-md overflow-hidden">
                                    <div>
                                        <div class="p-4">
                                            <h4 class="mb-0 text-lg">Información del cliente</h4>
                                            <hr>
                                            <h2 class="text-xl font-bold text-gray-800">{{ $customer->company_name }}</h2>
                                            <h3 class="text-xl font-bold text-gray-800">RUC {{ $customer->document }}</h3>
                                            <p class="mt-2 text-gray-600">{{ $customer->address }}</p>
                                            <p class="mt-2 text-gray-600">{{ $customer->phone }}</p>
                                            <div class="mt-4">
                                                <a href="{{ route('customers.index') }}" class="inline-block px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600">
                                                    <i data-feather="chevrons-left"></i>
                                                </a>
                                            </div>
                                        </div>
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
