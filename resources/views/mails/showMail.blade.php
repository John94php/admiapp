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
                <label class="badge bg-primary">Current folder : {{$s->mail_folder}}</label>
                <div class="btn-group float-end">
                    @csrf
                    <div class="dropdown">
                        <button class="btn btn-outline-primary dropdown-toggle btn-sm" type="button"
                                id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-expand-arrows-alt"></i>&nbsp;Move to
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <form action="{{route('mailbox.movetoFolder',$s->mail_id)}}" method="POST">
                                @method('POST')
                                @csrf

                                <li>
                                    <button type="submit" class="list-group-item list-group-item-action "
                                            name="foldername" value="inbox">Inbox
                                    </button>
                                </li>
                                <li>
                                    <button type="submit" class="list-group-item list-group-item-action "
                                            name="foldername" value="sent">Sent
                                    </button>
                                </li>
                                <li>
                                    <button type="submit" class="list-group-item list-group-item-action "
                                            name="foldername" value="drafts">Drafts
                                    </button>
                                </li>

                                @foreach($showcog as $cog)
                                    <?php

                                    $folders = explode(",", $cog->folders);
                                    ?>
                                @endforeach
                                @for($i=0;$i<sizeof($folders);$i++)
                                    <li>
                                        <button type="submit" class="list-group-item list-group-item-action "
                                                name="foldername" value="<?= $folders[$i]?>"><?= $folders[$i]?></button>
                                    </li>
                            @endfor
                        </ul>
                    </div>
                </form>
                    <button class="btn btn-sm btn-outline-success" data-bs-toggle="modal" data-bs-target="#replyModal" data-id="{{$s->mail_id}}"><i class="fas fa-reply"></i>&nbsp;Reply</button>

                    <form action="" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary btn-sm"><i class="fas fa-forward"></i>&nbsp;Forward
                            to
                        </button>
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
                            <?php $title = ($s->mail_folder == 'sent') ? 'To: ' . $s->mail_recipient : 'From: ' . $s->mail_sender;?>
                            <h5 class="card-title">{{$title}}</h5>
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
@foreach($show as $s)
<div class="modal fade" id="replyModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" data-id="{{$s->mail_id}}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Reply</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="{{route('mailbox.reply',$s->mail_id)}}" method="post">
                    @csrf

                    <p>Sender: <input type="text" readonly="readonly" name="mail_sender" value="{{$s->mail_recipient}}"/> </p>
                <p>Recipient: <input type="text" readonly="readonly" name="mail_recipient" value="{{$s->mail_sender}}"/> </p>
                 <p>Title: <input type="text" value="Re: {{$s->mail_title}}" name="mail_title"/></p>
                    <p> Last Message: <textarea class="form-control" name="mail_body" > {{"\n------------------------------------------------------------\n<".$s->mail_sender."> wrote: \n ".$s->mail_body}}</textarea></p>



                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-outline-primary"><i class="fas fa-paper-plane"></i>&nbsp;Send</button>

                    </div>
                </form>
            </div>


        </div>
    </div>
</div>
@endforeach
