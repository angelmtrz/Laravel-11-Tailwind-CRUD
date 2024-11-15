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
                            <div class="w-full max-w-3xl">
                                <div class="mt-3 rounded-lg shadow-lg overflow-hidden p-6 bg-white">
                                    <div class="flex justify-between items-center mb-2">
                                        <h4 class="mb-0 text-lg">Registrar Cliente</h4>
                                        <x-secondary-button-link href="{{ route('customers.index') }}">
                                            <i data-feather="chevrons-left"></i>
                                        </x-secondary-button-link>
                                    </div>
                                    <form class="p-4 bg-gray-100" action="{{ route('customers.store') }}" method="POST">
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
                                        <input type="hidden" name="user_id" value="{{ auth()->id() }}" required>
                                        <div class="mb-4">
                                            <label for="type" class="block text-gray-700">Tipo</label>
                                            <select class="mt-1 block w-full p-2 border border-gray-300 rounded" name="type">
                                                <option value="natural" {{ old('type') == 'natural' ? 'selected' : '' }}>Persona Natural</option>
                                                <option value="juridica" {{ old('type') == 'juridica' ? 'selected' : '' }}>Persona Jurídica</option>
                                            </select>
                                            <span class="text-red-600">{{ $errors->first('type') }}</span>
                                        </div>
                                        <div class="mb-4">
                                            <label for="document" class="block text-gray-700">Documento</label>
                                            <input type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded" name="document" maxlength="11" placeholder="Número de RUC" value="{{ old('document') }}">
                                            <span class="text-red-600">{{ $errors->first('document') }}</span>
                                        </div>
                                        <div class="mb-4">
                                            <label for="company_name" class="block text-gray-700">Razón Social</label>
                                            <input type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded" name="company_name" maxlength="100" placeholder="Razón Social" value="{{ old('company_name') }}">
                                            <span class="text-red-600">{{ $errors->first('company_name') }}</span>
                                        </div>
                                        <div class="mb-4">
                                            <label for="address" class="block text-gray-700">Dirección fiscal</label>
                                            <textarea class="mt-1 block w-full p-2 border border-gray-300 rounded" name="address" maxlength="255" placeholder="Dirección fiscal">{{ old('address') }}</textarea>
                                            <span class="text-red-600">{{ $errors->first('address') }}</span>
                                        </div>
                                        <div class="mb-4">
                                            <label for="phone" class="block text-gray-700">Telefono</label>
                                            <input type="text" class="mt-1 block w-full p-2 border border-gray-300 rounded" name="phone" maxlength="20" placeholder="Telefono" value="{{ old('phone') }}">
                                            <span class="text-red-600">{{ $errors->first('phone') }}</span>
                                        </div>
                                        <div class="flex justify-between items-center mb-2">
                                            <x-primary-button type="submit">{{ __('Registrar') }}</x-primary-button>
                                            <x-danger-button-link href="{{ route('customers.index') }}">{{ __('Cancelar') }}</x-dan>
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
