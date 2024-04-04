<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Todo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-xl text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <x-create-button href="{{ route('todo.create') }}"></x-create-button>
                        </div>
                        <div>
                            @if (session('success'))
                            <p x-data="{show: true}" x-show="show" x-transition
                            x-init="setTimeout(() => show = false, 500)"
                            class="text-sm text-green-600 dark:text-green-400">{{ session('success') }}
                        </p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Title
                                </th>
                                <th scope="col" class="hidden px-6 py-3 md:block">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($todos as $todo)
                                <tr class="odd:bg-white odd:dark:bg-gray-800 even:bg-gray-50 even:dark:bg-gray-700">
                                    <td scope="row" class="px-6 py-4 text-gray-900 font dark:text-white">
                                        <a href="{{ route('todo.edit', $todo) }}"
                                            class="hover:underline">{{ $todo->title }}</a>
                                    </td>
                                    <td class="hidden px-6 py-4 md:table-cell">
                                        @if ($todo->is_complete == false)
                                            <span
                                                class="mr-2 text-xs font-medium bg-blue-100 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                                Ongoing
                                            </span>
                                        @else
                                            <span
                                                class="mr-2 text-xs font-medium bg-green-100 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                                Completed
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex space-x-3">
                                            {{-- Action Here --}}
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr class="bg-white dark:bg-gray-800">
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                        Empty
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
