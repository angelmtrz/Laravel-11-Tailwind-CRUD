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
                            <div class="w-full max-w-md">
                                <div class="mt-3 rounded-lg shadow-lg overflow-hidden p-6 bg-white">
                                    <div class="flex justify-between items-center mb-2">
                                        <h4 class="mb-0 text-lg">Detalle del producto</h4>
                                        <x-secondary-button-link href="{{ route('products.index') }}">
                                            <i data-feather="chevrons-left"></i>
                                        </x-secondary-button-link>
                                    </div>
                                    <div class="p-4">
                                        <h5 class="text-lg font-bold uppercase">{{ $product->name }}</h5>
                                        <p class="mt-2 text-gray-700">{{ $product->description }}</p>
                                        <p class="mt-2 font-semibold">S/ {{ number_format($product->price, 2) }}</p>
                                    </div>
                                    <img src="{{ $product->image ? asset('storage/' .$product->image) : asset('assets/images/no-image.png') }}"
                                        class="w-full h-auto" alt="imagen">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
