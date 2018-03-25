@extends('layouts.main')

@section('main-content')
    <div class="row">
        @component('components.pageheader')
            Works
        @endcomponent
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading clearfix">
                    <h4 class="pull-left">Works</h4>
                    @permission('works.create')
                    <div class="input-group pull-right">
                        <button class="btn btn-success add-work">Add</button>
                    </div>
                    @endpermission
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th><span class="glyphicon glyphicon-th-list"></span></th>
                            <th>Name</th>
                            <th>Module Code</th>
                            <th>Title</th>
                            <th>Comments</th>
                            <th>Created</th>
                            @permission('works.destroy')
                            <th width="5%">Action</th>
                            @endpermission
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($works as $work)
                            <tr>
                                <td><a href="{{ route('works.show', ['id' => $work->id]) }}"><span class="glyphicon glyphicon-chevron-right"></span></a></td>
                                <td><a href="{{ route('users.show', ['id' => $work->user->id]) }}">{{ $work->user->full_name }}</a></td>
                                <td><a href="{{ route('modules.show', ['id' => $work->module->id]) }}">{{ $work->module->code }}</a></td>
                                <td>{{ $work->title}}</td>
                                <td>{{ count($work->feedbacks) }}</td>
                                <td>{{ $work->created_at->format('jS F Y H:i:s') }}</td>
                                @permission('works.destroy')
                                <td>
                                    @if($work->user_id == Auth::id())
                                        {!!  BootForm::open()->action(route('works.destroy', $work->id))->delete()->addClass('confirm-form') !!}
                                            {!! BootForm::submit('<span class="glyphicon glyphicon-remove"></span>')->addClass('btn-danger btn-sm btn-block') !!}
                                        {!! BootForm::close() !!}
                                    @endif
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
        @permission('works.create')
        $('.add-work').click(function() {
            bootbox.dialog({
                title: 'Add Work',
                message:
                '{!! BootForm::open()->action(route('works.store'))->addClass('bootstrap-modal-form')->id('add_work') !!}' +
                '{!! BootForm::select('Module', 'module_id', Auth::user()->getModuleArray()) !!}' +
                '{!! BootForm::text('Title', 'title') !!}' +
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
                            $('#add_work').submit();
                            return false;
                        }
                    }
                },
                backdrop: true,
                onEscape: true
            }).init(function() {
                $('#add_work').on('submit', function(submission)
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