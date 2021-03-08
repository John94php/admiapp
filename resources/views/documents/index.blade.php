<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Documents') }}
        </h2>
    </x-slot>
    @extends('documents.layout')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert">
                    <strong><i class="fas fa-thumbs-up"></i></strong> {{$message}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>

            @endif
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <button class="bg-blue-600 hover:bg-blue-700 px-3 py-1 rounded text-white m-5 show-modal"
                        id="newdocBtn"><i class="fas fa-plus"></i>&nbsp;add new
                </button>
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Main table</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Archive</a>
                    </li>

                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
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

                            @foreach($documents as $doc)
                                <?php
                                $bytes = $doc->size;
                                if ($bytes >= 1073741824)
                                {
                                    $bytes = number_format($bytes / 1073741824, 2) . ' GB';
                                }
                                elseif ($bytes >= 1048576)
                                {
                                    $bytes = number_format($bytes / 1048576, 2) . ' MB';
                                }
                                elseif ($bytes >= 1024)
                                {
                                    $bytes = number_format($bytes / 1024, 2) . ' KB';
                                }
                                elseif ($bytes > 1)
                                {
                                    $bytes = $bytes . ' bytes';
                                }
                                elseif ($bytes == 1)
                                {
                                    $bytes = $bytes . ' byte';
                                }
                                else
                                {
                                    $bytes = '0 bytes';
                                }

                                ?>

                                <tr>
                                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">{{$loop->iteration}}</td>
                                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">{{$doc->title}}</td>
                                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">{{$doc->type}}</td>
                                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">{{$bytes}}</td>
                                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static"><a href="download/{{$doc->us_id}}/{{$doc->title}}" class="inline-block rounded-full text-white bg-red-400 hover:bg-red-500 duration-300 text-xs font-bold mr-1 md:mr-2 mb-2 px-2 md:px-4 py-1         opacity-90 hover:opacity-100"><i class="fas fa-download"></i>&nbsp;Download</a></td>
                                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">{{$doc->name}}</td>
                                    @if($doc->us_id === Auth::user()->id)
                                        <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">
                                            <form action="{{route('documents.deletedoc',['id'=>$doc->id,'file'=>$doc->title])}}" id="deletedocForm" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="focus:outline-none text-red-600 text-sm py-2.5 px-5 rounded-full border border-red-600 hover:bg-red-50" id="deldocBtn">Delete</button>
                                            </form>
                                            @endif
                                        </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <table class="min-w-full leading-normal " id="documentsTable">
                            <thead>
                            <tr class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-center text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                <th>No</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Size</th>
                                <th>download</th>
                                <th>assigned to</th>
                                <th>modify date</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($archives as $arch)
                                <?php
                                $bytes = $arch->size;
                                if ($bytes >= 1073741824)
                                {
                                    $bytes = number_format($bytes / 1073741824, 2) . ' GB';
                                }
                                elseif ($bytes >= 1048576)
                                {
                                    $bytes = number_format($bytes / 1048576, 2) . ' MB';
                                }
                                elseif ($bytes >= 1024)
                                {
                                    $bytes = number_format($bytes / 1024, 2) . ' KB';
                                }
                                elseif ($bytes > 1)
                                {
                                    $bytes = $bytes . ' bytes';
                                }
                                elseif ($bytes == 1)
                                {
                                    $bytes = $bytes . ' byte';
                                }
                                else
                                {
                                    $bytes = '0 bytes';
                                }
                                ?>

                                <tr>
                                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">{{$loop->iteration}}</td>
                                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">{{$arch->title}}</td>
                                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">{{$arch->type}}</td>
                                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">{{$bytes}}</td>
                                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static"><a href="download/{{$arch->us_id}}/{{$arch->title}}" class="inline-block rounded-full text-white bg-red-400 hover:bg-red-500 duration-300 text-xs font-bold mr-1 md:mr-2 mb-2 px-2 md:px-4 py-1  opacity-90 hover:opacity-100"><i class="fas fa-download"></i>&nbsp;Download</a></td>
                                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">{{$arch->name}}</td>
                                    <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-b text-center block lg:table-cell relative lg:static">{{$arch->updated_at}}</td>


                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
<div class="modal h-screen w-full fixed left-0 top-0 flex justify-center items-center bg-black bg-opacity-50 hidden" id="newdocModal">
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
                                    <option>...</option>
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
                        <td><input type="file" name="filedoc" accept=".doc,.pdf"/></td>
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


