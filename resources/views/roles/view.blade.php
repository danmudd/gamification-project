@extends('layouts.main')

@section('main-content')
    <div class="row">
        @component('components.pageheader')
        Roles - {{ $role->display_name}}
        @endcomponent
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading clearfix">
                            <h4 class="pull-left">Role Info</h4>
                            @permission('roles.update')
                            <div class="input-group pull-right">
                                <button class="btn btn-primary edit-role">Edit</button>
                            </div>
                            @endpermission
                        </div>
                        <table class="table">
                            <tbody>
                            <tr>
                                <td>Name</td>
                                <td width="50%">{{ $role->name }}</td>
                            </tr>
                            <tr>
                                <td>Display Name</td>
                                <td>{{ $role->display_name }}</td>
                            </tr>
                            <tr>
                                <td>Description</td>
                                <td>{{ $role->description  }}</td>
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
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($role->users as $user)
                                <tr>
                                    <td><a href="{{ route('users.show', ['id' => $user->id]) }}"><span class="glyphicon glyphicon-chevron-right"></span></a></td>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->full_name }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h4 class="pull-left">Permissions</h4>
                    @permission('roles.permissions.add')
                    <div class="input-group pull-right">
                        <button class="btn btn-primary add-permission">Add</button>
                    </div>
                    @endpermission
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th><span class="glyphicon glyphicon-th-list"></span></th>
                            <th>Name</th>
                            <th>Display Name</th>
                            <th>Description</th>
                            @permission('roles.permissions.remove')
                            <th width="5%">Action</th>
                            @endpermission
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($role->perms as $permission)
                            <tr>
                                <td>{{$loop->iteration }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->display_name }}</td>
                                <td>{{ $permission->description}}</td>
                                @permission('roles.permissions.remove')
                                <td>
                                    {!!  BootForm::open()->action(route('roles.permissions.remove', array($role->id,$permission->id)))->delete()->addClass('confirm-form') !!}
                                    {!! BootForm::submit('<span class="glyphicon glyphicon-remove"></span>')->addClass('btn-danger btn-sm btn-block') !!}
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
@stop


@push('scripts')
<script>
    $(function()
    {
        @permission('roles.update')
        $('.edit-role').click(function() {
            bootbox.dialog({
                title: 'Edit Role',
                message:
                '{!!  BootForm::open()->action(route('roles.update', $role->id))->put()->addClass('bootstrap-modal-form')->id('edit_role') !!}' +
                '{!!  BootForm::bind($role) !!}' +
                '{!! BootForm::hidden('id') !!}' +
                '{!! BootForm::text('Name', 'name') !!}' +
                '{!! BootForm::text('Display Name', 'display_name') !!}' +
                '{!! BootForm::email('Description', 'description') !!}' +
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
                            $('#edit_role').submit();
                            return false;
                        }
                    }
                },
                backdrop: true,
                onEscape: true
            }).init(function() {
                $('#edit_role').on('submit', function(submission)
                {
                    $this = $(this);
                    $.submitModalForm(submission);
                });
            });
        });

        $('.add-permission').click(function() {
            bootbox.dialog({
                title: 'Add Permission',
                message:
                '{!!  BootForm::open()->action(route('roles.permissions.add', $role->id))->addClass('bootstrap-modal-form')->id('add_permission') !!}' +
                '{!! BootForm::hidden('role_id')->value($role->id) !!}' +
                '{!! BootForm::select('Permission', 'permission', $permissions) !!}' +
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
                            $('#add_permission').submit();
                            return false;
                        }
                    }
                },
                backdrop: true,
                onEscape: true
            }).init(function() {
                $('#add_permission').on('submit', function(submission)
                {
                    $this = $(this);
                    $.submitModalForm(submission);
                });
            });
        });
        @endpermission
    });
</script>
@endpush