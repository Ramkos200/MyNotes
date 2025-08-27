<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('NoteBooks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 text-xl text-white ">
            <div class="flex flex-col items-start gap-4 mb-6">
                <x-link-button href="{{ route('notebooks.create') }}">
                    + New NoteBook
                </x-link-button>
                <h1 class="text-2xl font-semibold"> {{ __('Here are all your NoteBooks') }}</h1>
            </div>
            @forelse($notebooks as $notebook)
                <div class="glass-container overflow-hidden shadow-sm sm:rounded-lg mb-5 mt-5">
                    <div class="p-6 text-white ">
                        <h2 class="text-3xl">

                            {{ $notebook->title }}

                        </h2>

                    </div>
                </div>
            @empty
                <p>You have no NoteBooks yet</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
