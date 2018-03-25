@extends('layouts.main')

@section('main-content')
    <div class="row">
        @component('components.pageheader')
            Modules - {{ $module->code }}
        @endcomponent
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading clearfix">
                            <h4 class="pull-left">Details</h4>
                            @permission('modules.update')
                            <div class="input-group pull-right">
                                <button class="btn btn-primary edit-module">Edit</button>
                            </div>
                            @endpermission
                        </div>
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>Code:</td>
                                <td width="50%">{{ $module->code }}</td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td>{{ $module->name }}</td>
                            </tr>
                            <tr>
                                <td>Description</td>
                                <td>{{ $module->description }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading clearfix">
                            <h4 class="pull-left">Users</h4>
                            @permission('modules.users.add')
                            <div class="input-group pull-right">
                                <button class="btn btn-success add-module-user">Add</button>
                            </div>
                            @endpermission
                        </div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th><span class="glyphicon glyphicon-th-list"></span></th>
                                <th>Username</th>
                                <th>Name</th>
                                @permission('modules.users.remove')
                                <th width="5%">Action</th>
                                @endpermission
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($module->users as $user)
                                <tr>
                                    <td><a href="{{ route('users.show', ['id' => $user->id]) }}"><span class="glyphicon glyphicon-chevron-right"></span></a></td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->full_name }}</td>
                                    @permission('modules.users.remove')
                                    <td>
                                        {!! BootForm::open()->action(route('modules.users.remove', array($module->id, $user->id)))->delete()->addClass('confirm-form') !!}
                                        {!! BootForm::submit('<span class="glyphicon glyphicon-remove"></span>')->addClass('btn-danger btn-sm') !!}
                                        {!! BootForm::close() !!}
                                    </td>
                                    @endpermission
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading clearfix">
                            <h4 class="pull-left">Works</h4>
                        </div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th><span class="glyphicon glyphicon-th-list"></span></th>
                                <th>Name</th>
                                <th>Title</th>
                                <th>Comments</th>
                                <th>Created</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($module->works as $work)
                                <tr>
                                    <td><a href="{{ route('works.show', ['id' => $work->id]) }}"><span class="glyphicon glyphicon-chevron-right"></span></a></td>
                                    <td><a href="{{ route('users.show', ['id' => $work->user->id]) }}">{{ $work->user->full_name }}</a></td>
                                    <td>{{ $work->title}}</td>
                                    <td>{{ count($work->feedbacks) }}</td>
                                    <td>{{ $work->created_at->format('jS F Y H:i:s') }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop


@push('scripts')
<script>
    $(function()
    {
        @permission('modules.update')
        $('.edit-module').click(function() {
            bootbox.dialog({
                title: 'Edit module',
                message:
                '{!!  BootForm::open()->action(route('modules.update', $module->id))->put()->addClass('bootstrap-modal-form')->id('edit_module') !!}' +
                '{!!  BootForm::bind($module) !!}' +
                '{!! BootForm::hidden('id') !!}' +
                '{!! BootForm::text('Code', 'code') !!}' +
                '{!! BootForm::text('Name', 'name') !!}' +
                '{!! BootForm::textarea('Description', 'description')->rows(3) !!}' +
                '{!! BootForm::close() !!}',
                buttons: {
                    cancel:{
                        label: "Cancel",
                        className: "btn-default",
                    },
                    submit:{
                        label: "Submit",
                        className: "btn-primary btn-submit",
                        callback: function() {
                            //post the data
                            $('#edit_module').submit();
                            return false;
                        }
                    }
                },
                backdrop: true,
                onEscape: true
            }).init(function() {
                $('#edit_module').on('submit', function(submission)
                {
                    $this = $(this);
                    $.submitModalForm(submission);
                });
            });
        });
        @endpermission

        @permission('modules.users.add')
        $('.add-module-user').click(function() {
            bootbox.dialog({
                title: 'Add module users',
                message:
                '{!!  BootForm::open()->action(route('modules.users.add', $module->id))->addClass('bootstrap-modal-form')->id('add_module_users') !!}' +
                '{!!  BootForm::bind($module) !!}' +
                '<table class="table" id="users-table"><thead><tr><th><span class="glyphicon glyphicon-th-list"></span></th><th>Username</th><th>Name</th></tr></thead><tbody>' +
                    @foreach($userlist as $user)
                        '<tr><td><input type="checkbox" name="users[{{ $user->id }}]"></input></td><td>{{ $user->username }}</td><td>{{ $user->full_name }}</td></tr>' +
                    @endforeach
                    '</tbody></table>' +
                '{!! BootForm::close() !!}',
                buttons: {
                    cancel:{
                        label: "Cancel",
                        className: "btn-default",
                    },
                    submit:{
                        label: "Add",
                        className: "btn-primary btn-submit",
                        callback: function() {
                            //post the data
                            var array = [];
                            var select = $('#add_module_users');

                            select.submit();
                            return false;
                        }
                    }
                },
                backdrop: true,
                onEscape: true
            }).init(function() {
                $('#add_module_users').on('submit', function(submission)
                {
                    $this = $(this);
                    $.submitModalForm(submission);
                });
            });
        });
        @endpermission
    });

    $(document).on('click', '#users-table tr', function() {
        ele = $(this).find('td input:checkbox')[0];
        ele.checked = ! ele.checked;
    });
    $(document).on('click', '#users-table input:checkbox', function(e){
        e.stopPropagation();
    });
</script>
@endpush