<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Contracts') }}
        </h2>
    </x-slot>
@extends('contracts.layout')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
{{--start--}}
                <nav id="header" class="w-full z-30 top-10 py-1 bg-white shadow-lg border-b border-blue-400 mt-24">
                    <div class="w-full flex items-center justify-between mt-0 px-6 py-2">
                        <label for="menu-toggle" class="cursor-pointer md:hidden block">
                            <svg class="fill-current text-blue-600" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                                <title>menu</title>
                                <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
                            </svg>
                        </label>
                        <input class="hidden" type="checkbox" id="menu-toggle">

                        <div class="hidden md:flex md:items-center md:w-auto w-full order-3 md:order-1" id="menu">
                            <nav>
                                <ul class="md:flex items-center justify-between text-base text-blue-600 pt-4 md:pt-0">
                                    <li>  <button class="bg-blue-600 hover:bg-blue-700 px-3 py-1 rounded text-white m-5 show-modal"
                                                  id="newdocBtn"><i class="fas fa-plus"></i>&nbsp;add new
                                        </button>
                                    </li>
                                </ul>
                            </nav>
                        </div>


                    </div>
                </nav>

{{--end--}}
                <div>
                    @if (session()->has('message'))
                        <div class="flex items-center">
                           <h2 class="text-green-500 text-2xl font-bold mr-2 ">Success</h2> <p class="text-sm text-gray-700">{{ session('message') }}</p>
                        </div>
                    @endif
                </div>

        </div>
<table class="min-w-max w-full table-auto">
    <thead>
    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
        <th class="py-3 px-6 text-center">No.</th>
        <th class="py-3 px-6 text-center">Name</th>
        <th class="py-3 px-6 text-center">Surname</th>
        <th class="py-3 px-6 text-center">Contract type</th>
        <th class="py-3 px-6 text-center">Contract period</th>
        <th class="py-3 px-6 text-center">Actions</th>
    </tr>
    </thead>
    <tbody>
    @foreach($contracts as $contract)
        <tr>
            <td class="py-3 px-6 text-center">{{$loop->iteration}}</td>
    <td class="py-3 px-6 text-center">{{$contract->name}}</td>
    <td class="py-3 px-6 text-center">{{$contract->lastname}}</td>
    <td class="py-3 px-6 text-center">{{$contract->type_name}}</td>
    <td class="py-3 px-6 text-center">{{$contract->type_period}}</td>
    <td class="py-3 px-6 text-center">
        <div class="flex item-center justify-center">
            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
            </div>
            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                </svg>
            </div>
            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                </svg>
            </div>
        </div>
    </td>
        </tr>
        @endforeach
    </tbody>
</table>
    </div>

</x-app-layout>
<div class="modal h-screen w-full fixed left-0 top-0 flex justify-center items-center bg-black bg-opacity-50 hidden" id="newcontractModal">
    <!-- modal -->
    <div class="bg-white rounded shadow-lg w-1/3">
        <!-- modal header -->
        <div class="border-b px-4 py-2 flex justify-between items-center">
            <h3 class="text-2xl font-semibold leading-tight">Add new contract</h3>
            <button class="text-black close-modal">&cross;</button>
        </div>
        <!-- modal body -->
        <div class="p-4 py-2 " >
                @livewire('contract-form')
            <button class="bg-red-600 hover:bg-red-700 px-3 py-1 rounded text-white mr-1 mt-5 close-modal">Cancel</button>
        </div>

    </div>
</div>
