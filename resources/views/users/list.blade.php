@extends('layouts.main')

@section('main-content')
    <div class="row">
        @component('components.pageheader')
            Users
        @endcomponent
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h4 class="pull-left">Users</h4>
                    @permission('users.create')
                    <div class="input-group pull-right">
                        <button class="btn btn-success add-user">Add</button>
                    </div>
                    @endpermission
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th><span class="glyphicon glyphicon-th-list"></span></th>
                            <th>Username</th>
                            <th>Forename</th>
                            <th>Surname</th>
                            <th>Email Address</th>
                            <th>Group</th>
                            <th>Created</th>
                            @permission('users.destroy')
                            <th width="5%">Action</th>
                            @endpermission
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td><a href="{{ route('users.show', ['id' => $user->id]) }}"><span class="glyphicon glyphicon-chevron-right"></span></a></td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->first_name }}</td>
                                <td>{{ $user->last_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>@if($user->roles->first())
                                        <a href="{{ route('roles.show', ['id' => $user->roles->first()->id]) }}">{{ $user->roles->first()->display_name }}</a>
                                    @else
                                        None!
                                    @endif
                                </td>
                                <td>{{ $user->created_at->format('jS F Y H:i:s') }}</td>
                                @permission('users.destroy')
                                <td>
                                    {!!  BootForm::open()->action(route('users.destroy', $user->id))->delete()->addClass('confirm-form') !!}
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
@endsection

@push('scripts')
<script>
    $(function()
    {
        @permission('users.create')
        $('.add-user').click(function() {
            bootbox.dialog({
                title: 'Add User',
                message:
                '{!! BootForm::open()->action(route('users.store'))->addClass('bootstrap-modal-form')->id('add_user') !!}' +
                '{!! BootForm::text('Username', 'username') !!}' +
                '{!! BootForm::email('Email Address', 'email') !!}' +
                '{!! BootForm::password('Password', 'password') !!}' +
                '{!! BootForm::password('Confirm Password', 'password_confirmation') !!}' +
                '{!! BootForm::text('First Name', 'first_name') !!}' +
                '{!! BootForm::text('Last Name', 'last_name') !!}' +
                '{!! BootForm::select('Group', 'role', $role_array) !!}' +
                '{!! BootForm::close() !!}',
                buttons: {
                    cancel:{
                        label: "Cancel",
                        className: "btn-default",
                    },
                    submit:{
                        label: "Create",
                        className: "btn-success btn-submit",
                        callback: function() {
                            //post the data
                            $('#add_user').submit();
                            return false;
                        }
                    }
                },
                backdrop: true,
                onEscape: true
            }).init(function() {
                $('#add_user').on('submit', function(submission)
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