<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mailbox') }}
            <a href="/mailbox">Back</a>
        </h2>
    </x-slot>
@extends('mails.layout')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form action="" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="from_email" class="form-label">From:</label>
                        <input type="email" class="form-control" id="from_email" name="mail_sender" value="{{Auth::user()->email}}">
                    </div>
                    <div class="mb-3">
                        <label for="to_email" class="form-label">To:</label>

                        <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Type to search...">
                        <datalist id="datalistOptions" name="mail_recipient">
                       @foreach($users as $user)
                        <option value="{{$user->name}} || {{$user->email}}"></option>
                           @endforeach
                        </datalist>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="mail_dw" name="mail_attachmentflag">
                        <label class="form-check-label" for="flexCheckDefault">
                            add DW
                        </label>

                    </div>
                    <div class="mb-3" id="dw" style="display: none">
                        <label for="to_email" class="form-label">DW:</label>

                        <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Type to search...">
                        <datalist id="datalistOptions" name="mail_recipient">
                            @foreach($users as $user)
                                <option value="{{$user->name}} || {{$user->email}}"></option>
                            @endforeach
                        </datalist>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id="mail_udw" name="mail_attachmentflag">
                        <label class="form-check-label" for="flexCheckDefault">
                        add UDW
                        </label>
                    </div>
                    <div class="mb-3" id="udw" style="display: none">
                        <label for="to_email" class="form-label">UDW:</label>

                        <input class="form-control" list="datalistOptions" id="exampleDataList" placeholder="Type to search...">
                        <datalist id="datalistOptions" name="mail_recipient">
                            @foreach($users as $user)
                                <option value="{{$user->name}} || {{$user->email}}"></option>
                            @endforeach
                        </datalist>
                    </div>
                    <div class="mb-3">
                        <label for="message_mail" class="form-label">Message</label>
                        <textarea class="form-control" id="message_mail" name="mail_body" rows="3"></textarea>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="0" id="mail_attachmentflag" name="mail_attachmentflag">
                        <label class="form-check-label" for="flexCheckDefault">
                           Check if want add attachments(max.4)
                        </label>
                    </div>
                    <div id="attachments" style="display: none">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Attachment 1</label>
                            <input class="form-control" type="file" id="attachment1" name="mail_attachment1">
                            <label for="formFile" class="form-label">Attachment 2</label>
                            <input class="form-control" type="file" id="attachment2" name="mail_attachment2">
                            <label for="formFile" class="form-label">Attachment 3</label>
                            <input class="form-control" type="file" id="attachment3" name="mail_attachment3">
                            <label for="formFile" class="form-label">Attachment 4</label>
                            <input class="form-control" type="file" id="attachment4" name="mail_attachment4">
                        </div>
                    </div>
                    <div class="btn-group-sm">
                        <button type="submit" class="btn btn-outline-success">Send</button>
                        <button type="reset" class="btn btn-outline-warning">Clear</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    $('#mail_attachmentflag:checkbox').on('click', function () {
        this.value = this.checked ? 1 : 0;
        $("#attachments").toggle();
    });
    $("#mail_dw:checkbox").on('click',function() {
        $("#dw").toggle();
    })
    $("#mail_udw:checkbox").on('click',function() {
        $("#udw").toggle();
    })
</script>
