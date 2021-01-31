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
            <i class="fas fa-newspaper"></i>
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
          <i class="fas fa-envelope-open"></i>

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
            <i class="fas fa-file-signature"></i>
            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold"><a
                    href="https://tailwindcss.com/">Documents</a></div>
        </div>

        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">

            </div>
        </div>
    </div>

    <div class="p-6 border-t border-gray-200 md:border-l">
        <div class="flex items-center">

            <i class="fas fa-file-contract"></i>
            <div class="ml-4 text-lg text-gray-600 leading-7 font-semibold">Contracts</div>
        </div>

        <div class="ml-12">
            <div class="mt-2 text-sm text-gray-500">

            </div>
        </div>
    </div>
</div>
