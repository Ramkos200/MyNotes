<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ !$note->Trashed() ? __('Your Note') : __('Your Trashed Note') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 text-xl text-white ">
            @if (session('success'))
                <p class="px-4 py-2 dark:bg-green-100 border rounded-md text-green-700 mb-5">
                    {{ session('success') }}
                </p>
            @endif
            <span class="px-4 py-2 mb-5 font-simibold dark:border-indigo-500 rounded-md shadow-sm dark:bg-gray-900">
                {{ $note->notebook->title }}
            </span>
            <div class="flex gap-6 mt-5 ">
                @if (!$note->Trashed())
                    <x-link-button href="{{ route('notes.edit', $note) }}" class="">Edit Note</x-link-button>
                    <form action="{{ route('notes.destroy', $note) }}" method="post">
                        @method('delete')
                        @csrf
                        <x-primary-button class="dark:bg-red-500 dark:hover:bg-red-700 dark:focus:bg-red-700 font-bold"
                            onclick="return confirm('Are you sure ??')">
                            Move Note to Trash
                        </x-primary-button>
                    </form>
                @else
                    <form action="{{ route('trashed.update', $note) }}" method="post">
                        @method('put')
                        @csrf
                        <x-primary-button>
                            Restore Trashed Note
                        </x-primary-button>
                    </form>
                    <form action="{{ route('trashed.destroy', $note) }}" method="post">
                        @method('delete')
                        @csrf
                        <x-primary-button class="dark:bg-red-500 dark:hover:bg-red-700 dark:focus:bg-red-700 font-bold"
                            onclick="return confirm('Are you sure ??')">
                            Delete Permanently
                        </x-primary-button>
                    </form>
                @endif


            </div>
            <div class="glass-container overflow-hidden shadow-sm sm:rounded-lg mb-5 mt-5">
                <div class="p-6 text-white ">
                    <h2 class="text-5xl mb-4">
                        {{ $note->title }}
                    </h2>
                    <p class=" text-lg mb-4 whitespace-pre-wrap"> {{ $note->text }} </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
