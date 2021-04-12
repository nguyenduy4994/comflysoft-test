<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
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
                            <span class="sr-only">Action</span>
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
</x-app-layout>
