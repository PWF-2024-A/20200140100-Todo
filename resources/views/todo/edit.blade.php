<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Todo') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="mx-auto max-w-7x1 sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <form action="{{ route('todo.update', $todo) }}" method="post", class="">
                @csrf
                @method('patch')
                <div class="p-6 bg-white border-b border-gray-200 sm:px-20">
                    <div class="text-2xl">
                        {{ __('Edit Todo Page') }}
                    </div>
                    <div class="mt-4">
                        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                        <input type="text" name="title" id="title" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" value="{{ $todo->title }}">
                    </div>
                    <div class="mt-4">
                        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea name="description" id="description" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ $todo->description }}</textarea>
                    </div>
                    <div class="mt-4">
                        <label for="is_complete" class="block text-sm font-medium text-gray-700">Status</label>
                        <select name="is_complete" id="is_complete" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <option value="0" {{ $todo->is_complete == 0 ? 'selected' : '' }}>Ongoing</option>
                            <option value="1" {{ $todo->is_complete == 1 ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>
                    <div class="flex items-center gap-4">
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Update
                        </button>

                        <x-cancel-button href="{{ route('todo.index') }}"></x-cancel-button>
                    </div>
                </form>
            </div>

        </div>

    </div>
</x-app-layout>
