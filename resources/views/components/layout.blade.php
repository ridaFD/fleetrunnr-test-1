<x-master>
    <ul class="flex w-full">
        <a class="hover:bg-yellow-600 bg-yellow-400 flex-1 text-center" href="{{ route('users.index') }}">
            <li class="p-2 border">home</li>
        </a>
        <a class="hover:bg-yellow-600 bg-yellow-400 flex-1 text-center" href="{{ route('users.create') }}">
            <li class="p-2 border">create user</li>
        </a>
        <a class="hover:bg-yellow-600 bg-yellow-400 flex-1 text-center" href="/">
            <li class="p-2 border">welcome</li>
        </a>
    </ul>
    {{ $slot }}
</x-master>

