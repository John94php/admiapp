<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mailbox') }}
        </h2>
    </x-slot>

    <div class="py-12">
        @if ($message = Session::get('success'))
        <p class="alert alert-info">{{$message}}</p>

        @endif

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @extends('mails.layout')
                <a href="{{route('mailbox.create')}}" class="btn btn-outline-dark m-t-md"><i class="fas fa-plus"></i>&nbsp;Create New</a>

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
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="cog-tab" data-bs-toggle="tab" href="#cog" role="tab"
                           aria-controls="cog" aria-selected="false"><i class="fas fa-cog"></i>&nbsp;Config</a>
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

                            </thead>
                            <tbody>
                            @foreach($inbox as $i)
                                        <?php
                                        $style = $i->mail_status == "unseen" ? "bold": "lighter";

                                        ?>
                                    <tr style="font-weight:{{$style}}">

                                        <td><a href="{{route('mailbox.show',$i->mail_id)}}">{{$i->mail_title}}</a></td>
                                    <td>{{$i->mail_sender}}</td>
                                    <td>{{$i->created_at}}</td>


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
                                        <form action="{{route('mailbox.restore',$t->mail_id)}}" method="POST">
                                            @csrf
                                        <button type="submit" class="btn btn-outline-warning"><i class="fas fa-undo"></i>&nbsp;Restore                                        </button>
                                        </form>
                                        <button type="button" class="btn btn-outline-danger"><i class="fas fa-trash"></i>&nbsp;Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>


                    </div>
                    <div class="tab-pane fade" id="cog" role="tabpanel" aria-labelledby="cog-tab">
                       <legend class="badge bg-primary">Config for account {{Auth::user()->email}}</legend>
                        <table class="table table-condensed small">
                            <tr>
                                <td>Folders list</td>
                                <td>      <ul class="list-group">
                                        <li class="list-group-item">Inbox</li>
                                        <li class="list-group-item">Sent</li>
                                        <li class="list-group-item">Drafts</li>
                                        <li class="list-group-item">Trash</li>

                                    </ul>
                                    <button class="btn btn-sm btn-outline-success" style="margin : 10px" data-bs-toggle="modal" data-bs-target="#addfolder">Add folder(s)</button>
                                    <button class="btn btn-sm btn-outline-danger" style="margin : 10px" data-bs-toggle="modal" data-bs-target="#deletefolder">Add folder(s)</button>

                                </td>
                            </tr>
                            <tr>
                                <td>Number of messages per page</td>
                                <td>
                                    <select class="float-start">
                                        <option>5</option>
                                        <option>10</option>
                                        <option>25</option>
                                        <option>50</option>
                                        <option>100</option>
                                    </select>

                                </td>
                            </tr>
                            <tr>
                                <td>Layout</td>
                                <td>
                                    <div class="list-group">
                                        <a href="#" class="list-group-item list-group-item-action active" aria-current="true">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1">Compact</h5>
                                            </div>
                                            <p class="mb-1">Default view.</p>
                                            <small>Click to change</small>
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1">Buisness</h5>
                                            </div>
                                            <p class="mb-1">List of folders is placing vertical and view is divided by three columns</p>
                                            <small class="text-muted">Click to change</small>
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1">Modal</h5>
                                            </div>
                                            <p class="mb-1">List of folders is placing vertical, each message is like list element, and view of message is like a modal</p>
                                            <small class="text-muted">Click to change</small>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </table>

                    </div>

                </div>


            </div>
        </div>
    </div>
</x-app-layout>
<div class="modal fade" id="addfolder" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add folder(s)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="input-group input-group-sm mb-3" id="folderdiv">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Folder name:</span>
                        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                    </div>
                </div>
                               <div class="modal-footer">
                <button id="addfield" class="btn btn-outline-dark" type="button">Add folder</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>

            </div>
            </form>

        </div>
    </div>
</div>
<div class="modal fade" id="deletefolder" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Delete folder(s)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
            <h4><label class="badge bg-secondary">Select folder(s) to remove</label></h4>
                    <select class="form-select" multiple aria-label="multiple select example">

                        <option value="1">One</option>
                        <option value="2">Two</option>
                        <option value="3">Three</option>
                    </select>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>

            </div>
            </form>

        </div>
    </div>
</div>
