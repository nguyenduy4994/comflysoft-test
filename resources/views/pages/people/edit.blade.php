<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('People') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-session-status class="mb-4" :status="session('status')" />

            <x-validation-errors class="mb-4" :errors="$errors" />

            <form action="{{ route('people.update', ['person' => $person]) }}" method="POST">
                @csrf
                @method('put')

                <!-- Name -->
                <div class="mb-4">
                    <x-label for="name" :value="__('Name')" />
                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name') ?? $person->name" required autofocus />
                </div>

                <div class="mb-4">
                    <x-button>
                        {{ __('Save') }}
                    </x-button>
                </div>
            </form>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Point
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Datetime
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($person->points as $point)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            Lat: {{ $point->position->getLat() }}<br>
                                            Long: {{ $point->position->getLng() }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $point->datetime }}
                                        </td>
                                    </tr>

                                    @empty
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap" colspan="2">
                                            {{ __('No point') }}
                                        </td>
                                    </tr>
                                    @endforelse

                                    <!-- More items... -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <a href="{{ route('point.index', ['personId' => $person->id]) }}" class="mb-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                {{ __('Edit point') }}
            </a>
            
        </div>
    </div>
</x-app-layout>