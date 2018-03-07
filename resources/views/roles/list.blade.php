@extends('layouts.main')

@section('main-content')
    <div class="row">
        @component('components.pageheader')
        Roles
        @endcomponent
    </div>
    <div class="row">
        <div class="col-md-12">

        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h4 class="pull-left">Roles</h4>
                    @permission('roles.create')
                    <div class="input-group pull-right">
                        <button class="btn btn-success add-role">Add</button>
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
                            <th width="80%">Description</th>
                            @permission('roles.destroy')
                            <th width="5%">Action</th>
                            @endpermission
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td><a href="{{ route('roles.show', ['id' => $role->id]) }}"><span class="glyphicon glyphicon-chevron-right"></span></a></td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->display_name }}</td>
                                <td>{{ $role->description }}</td>
                                @permission('roles.destroy')
                                <td>
                                    {!!  BootForm::open()->action(route('roles.destroy', $role->id))->delete()->addClass('confirm-form') !!}
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
        $('.add-role').click(function() {
            bootbox.dialog({
                title: 'Add Role',
                message:
                '{!! BootForm::open()->action(route('roles.store'))->addClass('bootstrap-modal-form')->id('add_role') !!}' +
                '{!! BootForm::text('Name', 'name') !!}' +
                '{!! BootForm::email('Display Name', 'display_name') !!}' +
                '{!! BootForm::text('Description', 'description') !!}' +
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
                            $('#add_role').submit();
                            return false;
                        }
                    }
                },
                backdrop: true,
                onEscape: true
            }).init(function() {
                $('#add_role').on('submit', function(submission)
                {
                    $this = $(this);
                    $.submitModalForm(submission);
                });
            });
        });
    });
</script>
@endpush