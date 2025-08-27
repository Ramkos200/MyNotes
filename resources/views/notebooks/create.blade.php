<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Create New NoteBook') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 text-xl text-white">
            <div class="glass-container overflow-hidden shadow-sm sm:rounded-lg mb-5 mt-5">
                <div class="p-6 text-white">
                    <form action="{{ route('notebooks.store') }}" method="POST">
                        @csrf
                        <x-text-input class="w-full mb-5" name="title" placeholder="NoteBook Title"
                            value="{{ @old('title') }}">
                        </x-text-input>
                        @error('title')
                            <div class="text-sm text-white mt-1">{{ $message }}</div>
                        @enderror
                        <x-primary-button>Save NoteBook</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
