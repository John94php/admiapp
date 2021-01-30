<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mailbox') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @extends('mails.layout')
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="inbox-tab" data-bs-toggle="tab" href="#inbox" role="tab"
                           aria-controls="inbox" aria-selected="true"><i class="fas fa-inbox"></i>&nbsp;Inbox</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="sent-tab" data-bs-toggle="tab" href="#sent" role="tab"
                           aria-controls="sent" aria-selected="false"><i
                                class="fas fa-paper-plane"></i>&nbsp;Sent</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="drafts-tab" data-bs-toggle="tab" href="#drafts" role="tab"
                           aria-controls="drafts" aria-selected="false"><i
                                class="fas fa-pencil-alt"></i>&nbsp;Drafts</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="trash-tab" data-bs-toggle="tab" href="#trash" role="tab"
                           aria-controls="trash" aria-selected="false"><i class="fas fa-trash"></i>&nbsp;Trash</a>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="inbox" role="tabpanel" aria-labelledby="inbox-tab">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>From</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </thead>
                            <tbody>
                            @foreach($inbox as $i)
                                        <?php
                                        $style = $i->mail_status == "unseen" ? "bold": "lighter";

                                        ?>
                                    <tr style="font-weight:{{$style}}">

                                    <td>{{$i->mail_title}}</td>
                                    <td>{{$i->mail_sender}}</td>
                                    <td>{{$i->created_at}}</td>
                                    <td>
                                        <a href="{{route('mailbox.show',$i->mail_id)}}" type="button" class="btn btn-outline-primary" data-id="{{$i->mail_id}}"  ><i class="fas fa-eye"></i>&nbsp;Show
                                        </a>
                                        <button type="button" class="btn btn-outline-danger"><i class="fas fa-trash"></i>&nbsp;Delete
                                        </button>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div class="tab-pane fade" id="sent" role="tabpanel" aria-labelledby="sent-tab">
                        <table class="table table-bordered">
                            <thead>
                            <tr>

                                <th>Title</th>
                                <th>To</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sent as $s)
                                <tr>
                                    <td>{{$s->mail_title}}</td>
                                    <td>{{$s->mail_recipient}}</td>
                                    <td>{{$s->created_at}}</td>
                                    <td>
                                        <button type="button" class="btn btn-outline-primary"><i class="fas fa-eye"></i>&nbsp;Show
                                        </button>
                                        <button type="button" class="btn btn-outline-danger"><i class="fas fa-trash"></i>&nbsp;Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>


                    </div>
                    <div class="tab-pane fade" id="drafts" role="tabpanel" aria-labelledby="drafts-tab">
                        <table class="table table-bordered">
                            <thead>
                            <tr>

                                <th>Title</th>
                                <th>To</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($drafts as $d)
                                <tr>
                                    <td>{{$d->mail_title}}</td>
                                    <td>{{$d->mail_recipient}}</td>
                                    <td>{{$d->created_at}}</td>
                                    <td>
                                        <button type="button" class="btn btn-outline-primary"><i class="fas fa-eye"></i>&nbsp;Show
                                        </button>
                                        <button type="button" class="btn btn-outline-warning"><i class="fas fa-edit"></i>&nbsp;Edit
                                        </button>
                                        <button type="button" class="btn btn-outline-danger"><i class="fas fa-trash"></i>&nbsp;Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>


                    </div>
                    <div class="tab-pane fade" id="trash" role="tabpanel" aria-labelledby="trash-tab">
                        <table class="table table-bordered">
                            <thead>
                            <tr>

                                <th>Title</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($trash as $t)
                                <tr>
                                    <td>{{$t->mail_title}}</td>
                                    <td>{{$t->created_at}}</td>
                                    <td>
                                        <button type="button" class="btn btn-outline-primary"><i class="fas fa-eye"></i>&nbsp;Show
                                        </button>
                                        <button type="button" class="btn btn-outline-warning"><i class="fas fa-undo"></i>&nbsp;Restore
                                        </button>
                                        <button type="button" class="btn btn-outline-danger"><i class="fas fa-trash"></i>&nbsp;Delete
                                        </button>
                                    </td>
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
