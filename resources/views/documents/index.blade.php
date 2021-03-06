<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Documents') }}
        </h2>
    </x-slot>
    @extends('documents.layout')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <button class="bg-blue-600 hover:bg-blue-700 px-3 py-1 rounded text-white m-5 show-modal" id="newdocBtn">show modal</button>

                <table class="min-w-full leading-normal " id="documentsTable">
                    <thead>
                    <tr class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        <th>No</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Size</th>
                        <th>download</th>
                        <th>assigned to</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
<div class="modal h-screen w-full fixed left-0 top-0 flex justify-center items-center bg-black bg-opacity-50 hidden">
    <!-- modal -->
    <div class="bg-white rounded shadow-lg w-1/3">
        <!-- modal header -->
        <div class="border-b px-4 py-2 flex justify-between items-center">
            <h3 class="font-semibold text-lg">Add new document</h3>
            <button class="text-black close-modal">&cross;</button>
        </div>
        <!-- modal body -->
        <div class="p-3">
            <form action="{{route('documents.store')}}" method="POST" >
                @csrf
                <label for="docname" class="block text-black">Name </label>
                <input type="text" autofocus id="docname" class="rounded-sm px-4 py-3 mt-3 focus:outline-none bg-gray-100 w-full" name="docname" placeholder="custom name of document" />
                <label for="doctype" class="block text-black">Type</label>
                <select name="doctype" id="doctype" class="rounded-sm px-4 py-3 mt-3 focus:outline-none bg-gray-100 w-full">
                @foreach($types as $type)
                    <option value="{{$type->id}}">{{$type->name}}</option>
                    @endforeach
                </select>
                <button class="bg-blue-600 hover:bg-blue-700 px-3 py-1 rounded text-white m-4" type="button" id="newtypeBtn"><i class="fas fa-plus"></i>&nbsp;define new</button>
                <div id="newtypediv" style="display: none">
                    <label for="docname" class="block text-black">Type name </label>
                    <input type="text" autofocus id="docname" class="rounded-sm px-4 py-3 mt-3 focus:outline-none bg-gray-100 w-full" name="docname" placeholder="custom name of type" />

                </div>
                <div class="flex justify-end items-center w-100 border-t p-3">
                    <button class="bg-blue-600 hover:bg-blue-700 px-3 py-1 rounded text-white" type="submit">Submit</button>
                </div>
            </form>
            <button class="bg-red-600 hover:bg-red-700 px-3 py-1 rounded text-white mr-1 close-modal">Cancel</button>

        </div>

    </div>
</div>


<script type="text/javascript">
    $(function () {
        var table = $("#documentsTable").DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{route('documents.index')}}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                {data: 'title', name: 'title'},
                {data: 'type', name: 'type'},
                {data: 'size', name: 'size'},
                {data: 'path', name: 'path'},
                {data: 'us_id', name: 'us_id'},
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                },
            ]
        });
    });

    //modal
    const modal = document.querySelector('.modal');

    const showModal = document.querySelector('.show-modal');
    const closeModal = document.querySelectorAll('.close-modal');

    showModal.addEventListener('click', function (){
        modal.classList.remove('hidden')
    });

    closeModal.forEach(close => {
        close.addEventListener('click', function (){
            modal.classList.add('hidden')
        });
    });
</script>


