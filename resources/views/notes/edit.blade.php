<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Edit your Note') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 text-xl text-white">
            <div class="glass-container overflow-hidden shadow-sm sm:rounded-lg mb-5 mt-5">
                <div class="p-6 text-white">
                    <form action="{{ route('notes.update', $note) }}" method="POST">
                        @method('put')
                        @csrf
                        <x-text-input class="w-full" name="title" placeholder="Note Title"
                            value="{{ @old('title', $note->title) }}">
                        </x-text-input>
                        @error('title')
                            <div class="text-sm text-white mt-1">{{ $message }}</div>
                        @enderror
                        <x-text-area class="w-full mt-5" name="text" placeholder="Note Content" rows="10"
                            value="{{ @old('text', $note->text) }}">
                        </x-text-area>
                        @error('text')
                            <div class="text-sm text-white mt-1 mb-5">{{ $message }}</div>
                        @enderror
                        <select name="notebook_id"
                            class="w-full mt-5 mb-5 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                            <option value=""> --Select NoteBook--</option>
                            @foreach ($notebooks as $notebook)
                                <option value="{{ $notebook->id }}" 
                                    @if ($notebook->id === $note->notebook_id) 
                                    selected
                                     @endif>
                                    {{ $notebook->title }}
                                </option>
                            @endforeach
                        </select>
                        <x-primary-button>Save Note</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
