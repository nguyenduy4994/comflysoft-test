<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('People') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-validation-errors class="mb-4" :errors="$errors" />

            <form action="{{ route('people.store') }}" method="POST">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <x-label for="name" :value="__('Name')" />
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                </div>

                <div class="mb-4">
                    <x-button>
                        {{ __('Save') }}
                    </x-button>
                </div>
            </form>
            
        </div>
    </div>
</x-app-layout>