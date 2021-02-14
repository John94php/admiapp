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
                <div class="btn-group float-end">
                    <form action="" method="post">
                        @csrf
                        <div class="dropdown">
                            <button class="btn btn-outline-primary dropdown-toggle btn-sm" type="button"
                                    id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-expand-arrows-alt"></i>&nbsp;Move to
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        {{--        <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>--}}
                                @foreach($showcog as $cog)
                                    <li>{{$cog->folders}}</li>

                                    @endforeach
                            </ul>
                        </div>
                    </form>
                    <form action="" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-success btn-sm"><i class="fas fa-reply"></i>&nbsp;Reply </button>
                    </form>
                    <form action="" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary btn-sm"><i class="fas fa-forward"></i>&nbsp;Forward to </button>
                    </form>
                    <form action="{{route('mailbox.moveToTrash',$s->mail_id)}}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger btn-sm "><i class="fas fa-trash"></i>&nbsp;
                            Delete
                        </button>
                    </form>
                </div>
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                    <div class="card text-center">
                        <div class="card-header">


                            Title: {{$s->mail_title}}
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
