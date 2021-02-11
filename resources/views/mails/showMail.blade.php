<x-app-layout>
    @extends('mails.layout')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mailbox') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="/mailbox" class="btn btn-outline-primary">Return</a>
            @foreach($show as $s)
                <div class="btn-group-sm float-end">

                    <a href="" class="btn btn-outline-primary"><i class="fas fa-expand-arrows-alt"></i>&nbsp;Move to</a>
                    <a href="" class="btn btn-outline-success"><i class="fas fa-reply"></i>&nbsp; Reply</a>
                    <a href="" class="btn btn-outline-secondary"><i class="fas fa-forward"></i>&nbsp;Forward to</a>
                    <a href="{{route('mailbox.destroy',$s->mail_id)}}" class="btn btn-outline-danger"><i class="fas fa-trash"></i>&nbsp;Delete</a>
                </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                    <div class="card text-center">
                    <div class="card-header">


                        Title:    {{$s->mail_title}}
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">From: {{$s->mail_sender}}</h5>
                        <p class="card-text">{{$s->mail_body}}</p>
                    </div>
                    <div class="card-footer text-muted">
                        {{$s->created_at}}
                    </div>
                </div>
                    @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
