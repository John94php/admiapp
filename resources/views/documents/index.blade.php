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
                <button class="bg-blue-600 hover:bg-blue-700 px-3 py-1 rounded text-white m-5 show-modal"
                        id="newdocBtn"><i class="fas fa-plus"></i>&nbsp;add new
                </button>

                <table class="min-w-full leading-normal " id="documentsTable">
                    <thead>
                    <tr class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        <th>No</th>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Size</th>
                        <th>download</th>
                        <th>assigned to</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($documents as $doc)

                        <tr>
                            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">{{$doc->id}}</td>
                            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">{{$doc->title}}</td>
                            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">{{$doc->type}}</td>
                            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">{{$doc->size}}</td>
                            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static"><a href="download/{{$doc->users}}/{{$doc->title}}">Download</a></td>
                            <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">{{$doc->users}}</td>

                        </tr>
                        @endforeach
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
            <form action="{{route('documents.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <table class="table table-condensed">
                    <tr>
                        <td><label for="name">Name</label></td>
                        <td>
                            <label>
                                <input type="text" name="name"/>
                            </label>
                        </td>
                    </tr>
                    <tr id="doctype">
                        <td><label for="type">Type</label></td>
                        <td>
                            <label>
                                <select name="type">
                                    @foreach($types as $type)
                                        <option value="{{$type->id}}">{{$type->name}}</option>
                                    @endforeach
                                </select>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>or add new type </td>
                        <td><button type="button" id="newtypeBtn" class="bg-blue-600 hover:bg-blue-700 px-3 py-1 rounded text-white" ><i class="fas fa-plus"></i>&nbsp;add new </button> </td>
                    </tr>
                    <tr id="newtypediv" style="display: none">
                        <td>Type name</td>
                        <td>
                            <label>
                                <input type="text" name="typename">
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td><label>File</label></td>
                        <td><input type="file" name="filedoc"/></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td> <button class="bg-blue-600 hover:bg-blue-700 px-3 py-1 rounded text-white" type="submit">Submit</button></td>
                    </tr>

                </table>

            </form>
            <button class="bg-red-600 hover:bg-red-700 px-3 py-1 rounded text-white mr-1 close-modal">Cancel</button>
        </div>

    </div>
</div>


<script type="text/javascript">

    //modal

</script>


