@extends('layouts.main')

@section('main-content')
    <div class="row">
        @component('components.pageheader')
            Users - {{ $user->full_name }}
        @endcomponent
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h4 class="pull-left">Profile</h4>
                    @permission('users.update')
                    <div class="input-group pull-right">
                        <button class="btn btn-primary edit-user">Edit</button>
                    </div>
                    @endpermission
                </div>
                <table class="table">
                    <tr>
                        <td><span class="glyphicon glyphicon-user"></span></td><td>{{ $user->full_name }}</td>
                    </tr>
                    <tr>
                        <td><span class="glyphicon glyphicon-tag"></span></td><td>{{ $user->roles->first() ? $user->roles->first()->display_name : 'None!' }}</td>
                    </tr>
                    <tr>
                        <td><span class="glyphicon glyphicon-envelope"></span></td><td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                    </tr>
                    <tr>
                        <td><span class="glyphicon glyphicon-calendar"></span></td><td>{{ $user->created_at->format('jS F Y H:i:s') }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading"><h3 class="panel-title">Comments</h3></div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th><span class="glyphicon glyphicon-th-list"></span></th>
                                <th width="100%">Comment</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($user->comments as $comment)
                            <tr>
                                <td><a href="{{ route('applications.show', ['id' => $comment->application_id]) }}"><span class="glyphicon glyphicon-chevron-right"></span></a></td>
                                <td>{{ $comment->comment }}</td>
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
        @permission('users.update')
        $('.edit-user').click(function() {
            bootbox.dialog({
                title: 'Edit User',
                message:
                '{!!  BootForm::open()->action(route('users.update', $user->id))->put()->addClass('bootstrap-modal-form')->id('edit_user') !!}' +
                '{!!  BootForm::bind($user) !!}' +
                '{!! BootForm::hidden('id') !!}' +
                '{!! BootForm::text('First Name', 'first_name') !!}' +
                '{!! BootForm::text('Last Name', 'last_name') !!}' +
                '{!! BootForm::email('Email Address', 'email') !!}' +
                '{!! BootForm::text('Username', 'username') !!}' +
				'{!! BootForm::select('Group', 'role', $roles) !!}' +
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
                            $('#edit_user').submit();
                            return false;
                        }
                    }
                },
                backdrop: true,
                onEscape: true
            }).init(function() {
                $('#edit_user').on('submit', function(submission)
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