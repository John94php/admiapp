<div class="p-6 sm:px-20 bg-white border-b border-gray-200">
    {{--
        <div>
            <x-jet-application-logo class="block h-12 w-auto" />
        </div>
    --}}

    <div class="mt-8 text-2xl">
        Welcome to AdmiApp
    </div>

    <div class="mt-6 text-gray-500">
        <p class="inline-block rounded-full text-white
        bg-black
        text-xs font-bold
        mr-1 md:mr-2 mb-2 px-2 md:px-4 py-1
        opacity-90 "><?= date('d-m-Y') ?></p>
    </div>
</div>

<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
    <div class="p-6">
        <div class="flex items-center">
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                 viewBox="0 0 24 24" class="w-8 h-8 text-gray-400">
                <path
                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
            </svg>
            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">
                <a href="/news" class="underline hover:text-blue-600">News section</a></div>
        </div>

        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">
                Check news
            </div>


        </div>
    </div>

    <div class="p-6 border-t border-gray-200 md:border-t-0 md:border-l">
        <div class="flex items-center">
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                 viewBox="0 0 24 24" class="w-8 h-8 text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M2.94 6.412A2 2 0 002 8.108V16a2 2 0 002 2h12a2 2 0 002-2V8.108a2 2 0 00-.94-1.696l-6-3.75a2 2 0 00-2.12 0l-6 3.75zm2.615 2.423a1 1 0 10-1.11 1.664l5 3.333a1 1 0 001.11 0l5-3.333a1 1 0 00-1.11-1.664L10 11.798 5.555 8.835z" clip-rule="evenodd" />
                </svg>

            </svg>
            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><a href="/mailbox" class="underline hover:text-blue-600">Mailbox</a>
            </div>
        </div>

        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">
                Internal mailbox
            </div>

        </div>
    </div>

    <div class="p-6 border-t border-gray-200">
        <div class="flex items-center">
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                 viewBox="0 0 24 24" class="w-8 h-8 text-gray-400">
                <path
                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><a
                    href="https://tailwindcss.com/">Tailwind</a></div>
        </div>

        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">
                Laravel Jetstream is built with Tailwind, an amazing utility first CSS framework that doesn't get in
                your way. You'll be amazed how easily you can build and maintain fresh, modern designs with this
                wonderful framework at your fingertips.
            </div>
        </div>
    </div>

    <div class="p-6 border-t border-gray-200 md:border-l">
        <div class="flex items-center">
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                 viewBox="0 0 24 24" class="w-8 h-8 text-gray-400">
                <path
                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
            </svg>
            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">Authentication</div>
        </div>

        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">
                Authentication and registration views are included with Laravel Jetstream, as well as support for user
                email verification and resetting forgotten passwords. So, you're free to get started what matters most:
                building your application.
            </div>
        </div>
    </div>
</div>
