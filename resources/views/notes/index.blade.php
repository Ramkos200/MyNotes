<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ request()->routeIs('notes.index') ? __('Notes') : __('Trash') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 text-xl text-white ">
            @if (session('success'))
                <p class="px-4 py-2 dark:bg-green-100 border rounded-md text-green-700 mb-5">
                    {{ session('success') }}
                </p>
            @endif

            <div class="flex flex-col items-start gap-4 mb-6">
                @if (request()->routeIs('notes.index'))
                    <x-link-button href="{{ route('notes.create') }}">
                        + New Note
                    </x-link-button>
                    <h1 class="text-2xl font-semibold"> {{ __('Here are all your Notes') }}</h1>
                @endif
            </div>
            @forelse($notes as $note)
                <div class="glass-container overflow-hidden shadow-sm sm:rounded-lg mb-5 mt-5">
                    <div class="p-6 text-white ">
                        <h2 class="text-3xl">
                            <a
                             @if (request()->routeIs('notes.index'))
                              href="{{ route('notes.show', $note) }}" 
                            @else
                              href="{{ route('trashed.show', $note) }}" 
                            @endif
                                class="hover:underline">
                                {{ $note->title }} </a>
                        </h2>
                        <p class="text-base"> {{ Str::limit($note->text, 200, '...') }} </p>
                        <span class=" text-xs opacity-30 mt-5">{{ $note->updated_at->diffForHumans() }}</span>
                    </div>
                </div>
            @empty
                <p>You have no Notes yet</p>
            @endforelse
            <!-- adding links for pagination -->
            {{ $notes->links() }}
        </div>


    </div>

</x-app-layout>
