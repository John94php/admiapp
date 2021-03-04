<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mailbox') }}
        </h2>
    </x-slot>
    @extends('mails.layout')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!-- początek -->
                <div class="container-fluid">
                    <div class="d-flex align-items-start" >
                        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical" style="border : 1px solid black">
                            <button class="nav-link active" id="v-pills-inbox-tab" data-bs-toggle="pill" data-bs-target="#v-pills-inbox" type="button" role="tab" aria-controls="v-pills-inbox" aria-selected="true"><i class="fas fa-inbox"></i>&nbsp;Inbox</button>
                            <button class="nav-link" id="v-pills-sent-tab" data-bs-toggle="pill" data-bs-target="#v-pills-sent" type="button" role="tab" aria-controls="v-pills-sent" aria-selected="false"><i class="fas fa-paper-plane"></i>&nbsp;Sent</button>
                            <button class="nav-link" id="v-pills-drafts-tab" data-bs-toggle="pill" data-bs-target="#v-pills-drafts" type="button" role="tab" aria-controls="v-pills-drafts" aria-selected="false"><i class="fas fa-pencil-alt"></i>&nbsp;Drafts</button>
                            <button class="nav-link" id="v-pills-trash-tab" data-bs-toggle="pill" data-bs-target="#v-pills-trash" type="button" role="tab" aria-controls="v-pills-trash" aria-selected="false"><i class="fas fa-trash"></i>&nbsp;Trash</button>
                            @foreach($configuration as $cog)
                                <?php    $folders = explode(",", $cog->folders); ?>
                            @foreach($folders as $folder)
                            <button class="nav-link" id="v-pills-<?=$folder?>-tab" data-bs-toggle="pill" data-bs-target="#v-pills-<?=$folder?>" type="button" role="tab" aria-controls="v-pills-<?=$folder?>" aria-selected="false"><i class="fas fa-folder"></i>&nbsp;<?=$folder?></button>
                            @endforeach
                            @endforeach
                            <hr>
                            <button class="nav-link" id="v-pills-config-tab" data-bs-toggle="pill" data-bs-target="#v-pills-config" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false"><i class="fas fa-cog"></i>&nbsp;Settings</button>

                        </div>
                        <div class="tab-content" id="v-pills-tabContent">
                            <div class="tab-pane fade show active" id="v-pills-inbox" role="tabpanel" aria-labelledby="v-pills-inbox-tab">
                                <table class="table table-condensed" style="width: 800px">
                                    <thead>
                                    <th>Title</th>
                                    <th>From</th>
                                    <th>Date</th>
                                    </thead>
                                    <tbody>
                                    @foreach($inbox as $i)
                                        <?php $style = $i->mail_status == "unseen" ? "bold" : "lighter"; ?>
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
                            <div class="tab-pane fade" id="v-pills-sent" role="tabpanel" aria-labelledby="v-pills-sent-tab">...</div>
                            <div class="tab-pane fade" id="v-pills-drafts" role="tabpanel" aria-labelledby="v-pills-drafts-tab">...</div>
                            <div class="tab-pane fade" id="v-pills-trash" role="tabpanel" aria-labelledby="v-pills-trash-tab">...</div>
                            @foreach($configuration as $cog)
                                <?php $folders = explode(",", $cog->folders);  ?>
                            @foreach($folders as $folder)
                                @if(!empty($folder))
                            <div class="tab-pane fade" id="v-pills-<?=$folder?>" role="tabpanel" aria-labelledby="v-pills-<?=$folder?>-tab">
                                <?=$folder ?>
                            </div>
                                @endif
                                @endforeach
                                @endforeach
                        </div>
                    </div>

                </div>
                <!-- koniec -->
            </div>
        </div>
    </div>
    </div>
</x-app-layout>
