<x-layout>
    <div class="container">
        <div class="grid min-h-screen place-items-center">
            <div class="w-11/12 p-12 bg-white sm:w-8/12 md:w-1/2 lg:w-5/12">
                <form class="mt-6" action="" method="post" enctype="multipart/form-data">

                    <div class="flex justify-between gap-3">
                        <span class="w-1/2">
                          <label for="firstname"
                                 class="block text-xs font-semibold text-gray-600 uppercase">Firstname</label>
                          <input id="firstname" type="text" name="first_name" placeholder="John"
                                 autocomplete="given-name"
                                 class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner"
                                 required/>
                        </span>

                        <span class="w-1/2">
                            <label for="lastname"
                                   class="block text-xs font-semibold text-gray-600 uppercase">Lastname</label>
                             <input id="lastname" type="text" name="last_name" placeholder="Doe"
                                    autocomplete="family-name"
                                    class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner"
                                    required/>
                        </span>
                    </div>

                    <label for="phone" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Phone</label>
                    <input id="phone" type="text" name="phone" placeholder="+961 78 975 888" autocomplete=""
                           class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner"
                           required/>

                    <label for="avatar" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Avatar</label>
                    <input id="avatar" type="file" name="avatar" placeholder="" autocomplete=""
                           class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner"
                           required/>

                    <label for="email" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">E-mail</label>
                    <input id="email" type="email" name="email" placeholder="john.doe@company.com" autocomplete="email"
                           class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner"
                           required/>

                    <label for="password"
                           class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Password</label>
                    <input id="password" type="password" name="password" placeholder="********"
                           autocomplete="new-password"
                           class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner"
                           required/>

                    <label for="password-confirm" class="block mt-2 text-xs font-semibold text-gray-600 uppercase">Confirm
                        password</label>
                    <input id="password-confirm" type="password" name="password-confirm" placeholder="********"
                           autocomplete="new-password"
                           class="block w-full p-3 mt-2 text-gray-700 bg-gray-200 appearance-none focus:outline-none focus:bg-gray-300 focus:shadow-inner"
                           required/>

                    <button type="submit"
                            class="w-full py-3 mt-6 font-medium tracking-widest text-white uppercase bg-black shadow-lg focus:outline-none hover:bg-gray-900 hover:shadow-none">
                        Sign up
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layout>
