<x-app-layout  >
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('News section') }}
        </h2>
    </x-slot>

    <div class="py-12" >
        @if ($message = Session::get('success'))

            <div class="bg-green-lightest border-l-4 border-green text-green-dark p-4" role="alert">
                <p>{{ $message }}</p>
            </div>

            </div>


        @endif
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
                        <form action="{{route('news.store')}}" method="POST">
                            @csrf

                            <div class="flex flex-col mx-40 mt-20">
                                <div class="flex items-center mb-4">
                                    <label for="author" class="w-24 font-semibold text-gray-700">Author</label>
                                    <input type="text" class="flex-grow border border-red-200 rounded py-1 px-3" name="news_author" value="{{Auth::user()->name}}"  />
                                </div>
                                <div class="flex items-center mb-4">
                                    <label for="post_title" class="w-24 font-semibold text-gray-700">Title</label>
                                    <input type="text" class="flex-grow border border-red-200 rounded py-1 px-3" name="news_title"  />
                                </div>
                                <div class="flex items-center mb-4">
                                    <label for="category_id" class="w-24 font-semibold text-gray-700">Category</label>
                                    <select name="category_id" class="flex-grow border border-red-200 rounded py-1 px-3">
                                        @foreach($category as $categ)

                                            <option value="{{$categ->category_id}}">{{$categ->category_title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="flex items-center mb-4">
                                    <textarea name="news_body" class="flex-grow border border-red-200 rounded py-1 px-3"  rows="8"></textarea>
                                </div>
                                <div class="flex items-center mb-4">
                                    <input type="hidden" name="created_at" value="{{date('d-m-Y H:i:s')}}">
                                    <button class="py-1 px-4 bg-red-800 text-red-100 font-semibold hover:bg-red-900 hover:shadow border border-red-200 rounded mr-2" type="submit">Submit</button>
                                </div>
                            </div>

                        </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            <!-- component -->
            <div class="md:px-32 py-8 w-full">
                <div class="shadow overflow-hidden rounded border-b border-gray-200">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Title</th>
                            <th class="w-1/3 text-left py-3 px-4 uppercase font-semibold text-sm">Author</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Content</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Category</th>
                        </tr>
                        </thead>
                        <tbody class="text-gray-700">
                        @foreach($all as $a)

                        <tr>
                            <td class="w-1/3 text-left py-3 px-4">{{$a->news_title}}</td>
                            <td class="w-1/3 text-left py-3 px-4">{{$a->news_author}}</td>
                            <td class="text-left py-3 px-4">{{$a->news_body}}</td>
                            <td class="text-left py-3 px-4">{{$a->category_title}}</td>

                        </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

                {!! $all->links() !!}
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
            $("#modal").trigger("reset");
        }
    }
</script>
