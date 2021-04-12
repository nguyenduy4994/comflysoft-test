<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Position') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-session-status class="mb-4" :status="session('status')" />

            <x-validation-errors class="mb-4" :errors="$errors" />

            <form action="{{ route('point.store', ['personId' => $personId]) }}" method="POST">
                @csrf

                <div class="mb-4 flex">
                    <div class="flex-1 pr-4">
                        <x-label for="lat" :value="__('Lat')" />
                        <x-input id="lat" class="block mt-1 w-full" type="text" name="lat" :value="old('lat')" required autofocus />
                    </div>
                    <div class="flex-1 pr-4">
                        <x-label for="long" :value="__('Long')" />
                        <x-input id="long" class="block mt-1 w-full" type="text" name="long" :value="old('long')" required autofocus />
                    </div>
                    <div class="flex-1">
                        <x-label for="datetime" :value="__('Datetime')" />
                        <x-input id="datetime" class="block mt-1 w-full" type="text" name="datetime" :value="old('datetime')" required autofocus />
                    </div>
                </div>

                <x-button class="mb-4">
                    {{ __('Add') }}
                </x-button>

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
                                            Position
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Datetime
                                        </th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Edit</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($points as $point)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            Lat: {{ $point->position->getLat() }}<br>
                                            Long: {{ $point->position->getLng() }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $point->datetime }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="#" class="text-indigo-600 hover:text-indigo-900">Delete</a>
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

            {{ $points->links() }}
        </div>
    </div>
</x-app-layout>