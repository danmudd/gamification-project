@extends('layouts.main')

@section('main-content')
    <div class="row">
        @component('components.pageheader')
            Works - {{ $work->title}}
        @endcomponent
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h4 class="pull-left">Details</h4>
                    @canedit($work->user->id, 'works.update')
                    <div class="input-group pull-right">
                        <button class="btn btn-primary edit-work">Edit</button>
                    </div>
                    @endcanedit
                </div>
                <table class="table">
                    <tbody>
                    <tr>
                        <td>User</td>
                        <td><a href="{{ route('users.show', ['id' => $work->user->id]) }}">{{ $work->user->full_name }}</a></td>
                    </tr>
                    <tr>
                        <td>Module</td>
                        <td><a href="{{ route('modules.show', ['id' => $work->module->id]) }}">{{ $work->module->code }}</a></td>
                    </tr>
                    <tr>
                        <td>Title</td>
                        <td>{{ $work->title}}</td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td>{{ $work->description }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading clearfix">
                            <h4 class="pull-left">Attachments</h4>
                            @canedit($work->user->id, 'works.attachments.create')
                            <div class="input-group pull-right">
                                <button class="btn btn-success add-work-attachment">Add</button>
                            </div>
                            @endcanedit
                        </div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th><span class="glyphicon glyphicon-th-list"></span></th>
                                <th>File</th>
                                @canedit($work->user->id, 'works.attachments.destroy')
                                <th width="5%">Action</th>
                                @endcanedit
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($work->attachments as $attachment)
                                <tr>
                                    <td>{{ $attachment->id }}</td>
                                    <td><a href="{{ route('works.attachments.show', [$work->id, $attachment->id]) }}">{{ $attachment->name . '.' .  pathinfo($attachment->path, PATHINFO_EXTENSION) }}</a></td>
                                    @canedit($work->user->id, 'works.attachments.destroy')
                                    <td>
                                        {!! BootForm::open()->action(route('works.attachments.destroy', array($work->id, $attachment->id)))->delete()->addClass('confirm-form') !!}
                                            {!! BootForm::submit('<span class="glyphicon glyphicon-remove"></span>')->addClass('btn-danger btn-sm') !!}
                                        {!! BootForm::close() !!}
                                    </td>
                                    @endcanedit
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
        @canedit($work->user->id, 'works.update')
        $('.edit-work').click(function() {
            bootbox.dialog({
                title: 'Edit work',
                message:
                '{!!  BootForm::open()->action(route('works.update', $work->id))->put()->addClass('bootstrap-modal-form')->id('edit_work') !!}' +
                '{!!  BootForm::bind($work) !!}' +
                '{!! BootForm::hidden('id') !!}' +
                '{!! BootForm::select('Module', 'module_id', $work->user->getModuleArray()) !!}' +
                '{!! BootForm::text('Title', 'title') !!}' +
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
                            $('#edit_work').submit();
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
        @endcanedit

        @canedit($work->user->id, 'works.attachments.create')
        $('.add-work-attachment').click(function() {
            bootbox.dialog({
                title: 'Add Attachment',
                message:
                '{!! BootForm::open()->action(route('works.attachments.store', $work->id))->addClass('bootstrap-modal-form')->id('add_work_attachment') !!}' +
                '{!! BootForm::hidden('work_id')->value($work->id) !!}' +
                '{!! BootForm::label('Files')->for('files') !!}' +
                '<div class="fileinput fileinput-new input-group" data-provides="fileinput">' +
                '<div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>' +
                '<span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span><input type="file" name="files" id="files" multiple></span>' +
                '<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>' +
                '</div>' +
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
                            $('#add_work_attachment').submit();
                            return false;
                        }
                    }
                },
                backdrop: true,
                onEscape: true
            }).init(function() {
                $('#add_work_attachment').on('submit', function(submission)
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