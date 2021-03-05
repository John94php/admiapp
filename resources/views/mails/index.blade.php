<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mailbox') }}
        </h2>
    </x-slot>
    @extends('mails.layout')

    <div class="py-12">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert">
                <strong><i class="fas fa-thumbs-up"></i></strong> {{$message}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>

        @endif

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{route('mailbox.create')}}" class="btn btn-outline-dark m-t-md"><i class="fas fa-plus"></i>&nbsp;Create
                New</a>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg m-t-md">


                <ul class="nav nav-pills" id="myTab" role="tablist">
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
                    @foreach($configuration as $cog)
                        <?php
                        $folders = explode(",", $cog->folders);

                        ?>
                        @foreach($folders as $folder)
                            @if(!empty($folder))
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="<?=$folder?>-tab" data-bs-toggle="tab" href="#<?=$folder?>"
                                       role="tab" aria-controls="<?=$folder?>" aria-selected="false"><i
                                            class="fas fa-folder"></i>&nbsp;<?=$folder?></a>
                                </li>
                            @endif
                        @endforeach
                    @endforeach
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
                                $style = $i->mail_status == "unseen" ? "bold" : "lighter";

                                ?>
                                <tr style="font-weight:{{$style}}">

                                    <td><a href="{{route('mailbox.show',$i->mail_id)}}">{{$i->mail_title}}</a></td>
                                    <td>{{$i->mail_sender}}</td>
                                    <td>{{$i->created_at}}</td>


                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        {{ $inbox->onEachSide($number)->links() }}

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
                                    <td><a href="{{route('mailbox.show',$s->mail_id)}}">{{$s->mail_title}}</a></td>
                                    <td>{{$s->mail_recipient}}</td>
                                    <td>{{$s->created_at}}</td>

                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                        {{ $sent->onEachSide($number)->links() }}
                    </div>
                    <div class="tab-pane fade" id="drafts" role="tabpanel" aria-labelledby="drafts-tab">
                        <table class="table table-bordered">
                            <thead>
                            <tr>

                                <th>Title</th>
                                <th>To</th>
                                <th>Date</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($drafts as $d)
                                <tr>
                                    <td><a href="{{route('mailbox.show',$d->mail_id)}}">{{$d->mail_title}}</a></td>
                                    <td>{{$d->mail_recipient}}</td>
                                    <td>{{$d->created_at}}</td>

                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                        {{ $drafts->onEachSide($number)->links() }}


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
                                            <button type="submit" class="btn btn-outline-warning"><i
                                                    class="fas fa-undo"></i>&nbsp;Restore
                                            </button>
                                        </form>
                                        <button type="button" class="btn btn-outline-danger"><i
                                                class="fas fa-trash"></i>&nbsp;Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>

                        </table>
                        {{ $trash->onEachSide($number)->links() }}

                    </div>
                    @foreach($mysteryfold as $mf)
                        <?php $folders = explode(",", $mf->folders)?>
                        @foreach($folders as $folder)
                            <div class="tab-pane fade" id="<?= $folder?>" role="tabpanel"
                                 aria-labelledby="<?= $folder?>-tab">
                                <?php  $newbox = DB::table('mails')->where('mail_folder', '=', $folder)->get();?>
                                <table class="table table-bordered">
                                    <thead>
                                    <th>Title</th>
                                    <th>Created at</th>
                                    </thead>
                                    <tbody>
                                    @foreach($newbox as $box)
                                        <tr>

                                            <td>
                                                <a href="{{route('mailbox.show',$box->mail_id)}}">{{$box->mail_title}}</a>
                                            </td>
                                            <td>{{$box->created_at}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                    {{ $mysteryfold->onEachSide($number)->links() }}
                            </div>

                        @endforeach
                    @endforeach


                    <div class="tab-pane fade" id="cog" role="tabpanel" aria-labelledby="cog-tab">
                        <legend class="badge bg-primary">Config for account {{Auth::user()->email}}</legend>
                        <table class="table table-condensed small">
                            <tr>
                                <td>Folders list</td>
                                <td>
                                    <ul class="list-group">
                                        <li class="list-group-item">Inbox</li>
                                        <li class="list-group-item">Sent</li>
                                        <li class="list-group-item">Drafts</li>
                                        <li class="list-group-item">Trash</li>
                                        @foreach($configuration as $cog)
                                            <?php
                                            $folders = explode(",", $cog->folders);
                                            ?>
                                            @foreach($folders as $fold)

                                                <li class="list-group-item">{{$fold}}</button></li>

                                            @endforeach

                                        @endforeach
                                    </ul>
                                    <button class="btn btn-sm btn-outline-success" style="margin : 10px"
                                            data-bs-toggle="modal" data-bs-target="#addfolder">Add folder
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger" style="margin : 10px"
                                            data-bs-toggle="modal" data-bs-target="#deletefolder">Delete folder
                                    </button>

                                </td>
                            </tr>
                            <tr>
                                <td>Number of messages per page</td>
                                <td>
                                    <form action="{{route('mailbox.msgcount')}}" method="post">
                                        @csrf
                                    <select class="float-start" name="msgcount" id="msgcount">
                                        <option value="0">...</option>
                                        <option value="5">5</option>
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        </select>
                                        <button type="submit" class="btn btn-outline-dark btn-sm" id="msgcountBtn">Change</button>
                                    </form>
                                </td>
                            </tr>
                            <tr>
                                <td>Layout <badge class="badge bg-blue-900">{{$view}}</badge></td>
                                <td>

                                    <div class="list-group">

                                        <form action="{{route('mailbox.changelayout')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}"/>
                                        <button type="submit" class="list-group-item list-group-item-action "
                                           aria-current="true">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1" >Compact</h5>
                                            <input type="hidden" name="layout" value="compact"/>
                                            </div>
                                            <p class="mb-1">Default view.</p>
                                            <small>Click to change</small>
                                        </button>
                                        </form>
                                        <form action="{{route('mailbox.changelayout')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{Auth::user()->id}}"/>
                                        <button type="submit" class="list-group-item list-group-item-action ">
                                            <div class="d-flex w-100 justify-content-between">
                                                <h5 class="mb-1">Buisness</h5>
                                                <input type="hidden" name="layout" value="buisness"/>
                                            </div>
                                            <p class="mb-1">List of folders is placing vertical and view is divided by
                                                two columns(right view is like table with messagess)</p>
                                            <small class="text-muted">Click to change</small>
                                        </button>
                                        </form>

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
<div class="modal fade" id="addfolder" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add folder</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('mailbox.addfolders')}}" method="post">
                    @csrf
                    <input type="hidden" name="user_id" value="{{Auth::user()->id}}"/>
                    <div class="input-group input-group-sm mb-3" id="folderdiv">
                        <span class="input-group-text" id="inputGroup-sizing-sm">Folder name:</span>
                        <input type="text" class="form-control" name="mail_folder"
                               aria-describedby="inputGroup-sizing-sm">
                    </div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>


        </div>
    </div>
</div>
<div class="modal fade" id="deletefolder" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
     aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Delete folder</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('mailbox.deletefolder')}}" method="post">
                    @csrf
                    <input type="hidden" value="{{Auth::user()->id}}" name="user_id"/>
                    <h4><label class="badge bg-secondary">Select folder to remove</label></h4>
                    <select class="form-select"  aria-label="multiple select example" name="folder[]">
                        @foreach($configuration as $cog)
                            <?php
                            $folders = explode(",", $cog->folders);
                            ?>

                            @foreach($folders as $fold)

                                <option value="{{$fold}}">{{$fold}}</option>

                            @endforeach

                        @endforeach

                    </select>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>

                    </div>
                </form>
            </div>


        </div>
    </div>
</div>
