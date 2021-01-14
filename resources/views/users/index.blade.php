<x-layout>
    <div class="container w-full m-2 flex">
        <div class="border border-red-500 p-2">
            <form action="{{ route('search') }}" method="get" class="flex items-center">
                @csrf

                <div class="mr-4">
                    <div>
                        <label class="flex items-center">
                            <input name="verified" type="checkbox" class="form-checkbox text-indigo-600">
                            <span class="ml-2">Verified</span>
                        </label>
                    </div>
                    <div>
                        <label class="flex items-center">
                            <input name="is_active" type="checkbox" class="form-checkbox text-green-500">
                            <span class="ml-2">Active</span>
                        </label>
                    </div>
                </div>

                <label class="block w-96">
                    <input name="term" type="text" class="border border-black p-1.5 block w-full"
                           placeholder="search...">
                </label>

                <button type="submit"
                        class="bg-blue-500 px-2 ml-1 py-1 font-medium text-white text-center hover:bg-blue-600">Submit
                </button>
            </form>

            <div class="flex justify-between sm:flex-wrap mt-4">
                @if(!empty($results))
                    @foreach($results as $result)
                        <ul class="border border-black sm:mb-2">
                            <li>
                                <span class="font-bold bg-yellow-500">id: </span>{{ $result['id'] }}
                            </li>
                            <li>
                                <span class="font-bold bg-yellow-500">First Name: </span>{{ $result->first_name }}
                            </li>
                            <li>
                                <span class="font-bold bg-yellow-500">Last Name: </span>{{ $result->last_name }}
                            </li>
                            <li>
                                <span class="font-bold bg-yellow-500">Phone Number: </span>{{ $result->phone }}
                            </li>
                            <li>
                                <span class="font-bold bg-yellow-500">Avatar: </span>{{ $result->avatar }}
                            </li>
                            <li>
                                <span class="font-bold bg-yellow-500">Active: </span>{{ $result->is_active }}
                            </li>
                            <li>
                                <span class="font-bold bg-yellow-500">Email: </span>{{ $result->email }}
                            </li>
                            <li>
                                <span class="font-bold bg-yellow-500">Verified: </span>{{ $result->email_verified_at }}
                            </li>
                            <li>
                                <span
                                    class="font-bold bg-yellow-500">Permissions: </span>{{ $result->pivot->permissions }}
                            </li>
                        </ul>
                    @endforeach
                @endif
            </div>
        </div>

        <div class="border border-red-500 p-2 text-sm">
            @foreach($users as $user)
                <ul class="border border-black  p-2 mb-2">
                    <li>
                        <span class="font-bold bg-yellow-500">id: </span>{{ $user->id }}
                    </li>
                    <li>
                        <span class="font-bold bg-yellow-500">First Name: </span>{{ $user->first_name }}
                    </li>
                    <li>
                        <span class="font-bold bg-yellow-500">Last Name: </span>{{ $user->last_name }}
                    </li>
                    <li>
                        <span class="font-bold bg-yellow-500">Phone Number: </span>{{ $user->phone }}
                    </li>
                    <li>
                        <span class="font-bold bg-yellow-500">Avatar: </span>{{ $user->avatar }}
                    </li>
                    <li>
                        <span class="font-bold bg-yellow-500">Active: </span>{{ $user->is_active }}
                    </li>
                    <li>
                        <span class="font-bold bg-yellow-500">Email: </span>{{ $user->email }}
                    </li>
                    <li>
                        <span class="font-bold bg-yellow-500">Verified: </span>{{ $user->email_verified_at }}
                    </li>
                    <li>
                        <span class="font-bold bg-yellow-500">Permissions: </span>{{ $user->pivot->permissions }}
                    </li>
                </ul>

                <form action="{{ route('users.edit', $user->id) }}" method="get">
                    @csrf
                    <button type="submit"
                            class="uppercase px-8 py-2 rounded-full bg-yellow-300 text-yellow-600 max-w-max shadow-sm hover:shadow-lg">
                        Edit
                    </button>
                </form>
                <form action="{{ route('users.destroy', $user->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="uppercase px-8 py-2 rounded-full bg-red-300 text-red-600 max-w-max shadow-sm hover:shadow-lg">
                        Delete
                    </button>
                </form>
            @endforeach
            {{ $users->links() }}
        </div>
    </div>
</x-layout>
