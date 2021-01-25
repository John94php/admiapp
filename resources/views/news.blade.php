<x-app-layout  >
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('News section') }}
        </h2>
    </x-slot>

    <div class="py-12" >
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <button id="openBtn" class="border border-green-500 text-green-500 rounded-md px-4 py-2 m-2 transition duration-500 ease select-none hover:text-white hover:bg-green-600 focus:outline-none focus:shadow-outline">Add new News</button>

                <div id="modal" class="modal-bg transition-opacity duration-500 opacity-0 pt-16 fixed w-full h-full left-0 z-10 overflow-auto">
                    <div class="modal-content relative m-auto bg-gray-100 w-4/5 shadow-lg">
                        <div class="p-4 bg-gray-700 text-white">
                            <span class="closeBtn float-right text-lg font-bold hover:text-gray-500 no-underline cursor-pointer">&times;</span>
                            <h2>Add new News</h2>
                        </div>
                        <div class="p-4">
                            <div class="flex-grow">
                                <div class="flex flex-col mx-40 mt-20">
                                    <div class="flex items-center mb-4">
                                        <label for="author" class="w-24 font-semibold text-gray-700">Author</label>
                                        <input type="text" class="flex-grow border border-red-200 rounded py-1 px-3" value="{{Auth::user()->name}}" readonly />
                                    </div>
                                    <div class="flex items-center mb-4">
                                        <label for="post_title" class="w-24 font-semibold text-gray-700">Title</label>
                                        <input type="text" class="flex-grow border border-red-200 rounded py-1 px-3"  />
                                    </div>
                                    <div class="flex items-center mb-4">
                                        <label for="category_id" class="w-24 font-semibold text-gray-700">Category</label>
                                  {{--      <select name="" class="flex-grow border border-red-200 rounded py-1 px-3">
                                            @foreach($category as $categ)

                                                <option value="{{$categ->category_id}}">{{$categ->category_title}}</option>
                                                @endforeach
                                        </select>--}}
                                    </div>
                                    <div class="flex items-center mb-4">
                                        <textarea name="description" class="flex-grow border border-red-200 rounded py-1 px-3" id="description" rows="8"></textarea>
                                    </div>
                                    <div class="flex items-center mb-4">
                                        <button class="py-1 px-4 bg-red-800 text-red-100 font-semibold hover:bg-red-900 hover:shadow border border-red-200 rounded mr-2">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            @foreach ($all as $a)
                <table class="border-collapse w-full">
                    <thead>
                    <tr>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Title</th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Author</th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Category</th>
                        <th class="p-3 font-bold uppercase bg-gray-200 text-gray-600 border border-gray-300 hidden lg:table-cell">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Title</span>
                            {{$a->news_title}}
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Author</span>
                            {{$a->news_author}}
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Author</span>
                            {{$a->category_id}}
                        </td>
                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-xs font-bold uppercase">Actions</span>
                            <a href="#" class="text-blue-400 hover:text-blue-600 underline">View</a>
                            <a href="#" class="text-blue-400 hover:text-blue-600 underline pl-6">Edit</a>
                            <a href="#" class="text-blue-400 hover:text-blue-600 underline pl-6">Remove</a>
                        </td>
                    </tbody>
                </table>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    var modal = document.querySelector("#modal");
    var openBtn = document.querySelector("#openBtn");
    var closeBtn = document.querySelector(".closeBtn");

    openBtn.onclick = function() {
        modal.classList.add('opacity-100');
        modal.classList.add('z-50');
        $("#modal").css('bottom','50px');

    }

    closeBtn.onclick = function() {
        modal.classList.remove('opacity-100');
        modal.classList.remove('z-50');
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.classList.remove('opacity-100');
            modal.classList.remove('z-50');
        }
    }
</script>
