@extends('layouts.main')

@section('main-content')
    <div class="row">
        @component('components.pageheader')
            Modules
        @endcomponent
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h4 class="pull-left">Modules</h4>
                    @permission('modules.create')
                    <div class="input-group pull-right">
                        <button class="btn btn-success add-module">Add</button>
                    </div>
                    @endpermission
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th><span class="glyphicon glyphicon-th-list"></span></th>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Description</th>
                            @permission('modules.destroy')
                            <th width="5%">Action</th>
                            @endpermission
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($modules as $module)
                            <tr>
                                <td><a href="{{ route('modules.show', ['id' => $module->id]) }}"><span class="glyphicon glyphicon-chevron-right"></span></a></td>
                                <td>{{ $module->code }}</td>
                                <td>{{ $module->name }}</td>
                                <td>{{ $module->description }}</td>
                                @permission('modules.destroy')
                                <td>
                                    {!!  BootForm::open()->action(route('modules.destroy', $module->id))->delete()->addClass('confirm-form') !!}
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
        @permission('modules.destroy')
        $('.add-module').click(function() {
            bootbox.dialog({
                title: 'Add User',
                message:
                '{!! BootForm::open()->action(route('modules.store'))->addClass('bootstrap-modal-form')->id('add_module') !!}' +
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
                        label: "Create",
                        className: "btn-success btn-submit",
                        callback: function() {
                            //post the data
                            $('#add_module').submit();
                            return false;
                        }
                    }
                },
                backdrop: true,
                onEscape: true
            }).init(function() {
                $('#add_module').on('submit', function(submission)
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