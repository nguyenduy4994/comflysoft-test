<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Position') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="mb-2 text-xl">{{ __('Selected Position') }}</h2>
            <div class="mb-4">
                - Lat: {{ $currentPoint->position->getLat() }} <br>
                - Long: {{ $currentPoint->position->getLng() }} <br>
                - Datetime: {{ $currentPoint->datetime }}
            </div>

            <h2 class="mb-2 text-xl">{{ __('Person') }}</h2>
            <div class="mb-4">
                - Name: {{ $currentPoint->person->name }}
            </div>

            <h2 class="mb-2 text-xl">{{ __('Exposed position') }}</h2>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Person
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Position
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Datetime
                                        </th>
                                        <th scope="col" class="relative px-6 py-3">
                                            <span class="sr-only">Action</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($points as $point)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $point->person->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            Lat: {{ $point->position->getLat() }}<br>
                                            Long: {{ $point->position->getLng() }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $point->datetime }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('point.show', $point) }}" class="text-indigo-600 hover:text-indigo-900">View</a>
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

            <!-- Map -->
            <div id="map" class="map"></div>
            <!-- End map -->

            <x-slot name="scripts">
                <script src="https://unpkg.com/elm-pep"></script>
                <script>
                    const RADIUS = {{ config('expose.radius') }};

                    var currentPointPosition = [
                        {{ $currentPoint->position->getLng() }}, 
                        {{ $currentPoint->position->getLat() }}
                    ]; // lng, lat

                    var exposedPointPositions = [
                        @foreach($points as $point)
                        [{{ $point->position->getLng() }}, {{ $point->position->getLat() }}],
                        @endforeach
                    ];

                </script>
                <script src="/js/maps/main.js"></script>
            </x-slot>
        </div>
    </div>
</x-app-layout>