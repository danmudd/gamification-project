@extends('layouts.main')

@section('main-content')
    <div class="row">
        @component('components.pageheader')
            Users - {{ $user->full_name }}
        @endcomponent
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading clearfix">
                            <h4 class="pull-left">Profile</h4>
                            @canedit($user->id, 'users.update')
                            <div class="input-group pull-right">
                                <button class="btn btn-primary edit-user">Edit</button>
                            </div>
                            @endcanedit
                        </div>
                        <table class="table">
                            <tr>
                                <td><span class="glyphicon glyphicon-user"></span></td><td>{{ $user->full_name }}</td>
                            </tr>
                            <tr>
                                <td><span class="glyphicon glyphicon-tag"></span></td><td>
                                    @if($user->roles->first())
                                        <a href="{{ route('roles.show', ['id' => $user->roles->first()->id]) }}">{{ $user->roles->first()->display_name }}</a>
                                    @else
                                        None!
                                    @endif</td>
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
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading clearfix">
                            <h4 class="pull-left">Modules</h4>
                        </div>
                        <table class="table">
                            <thead>
                            <tr>
                                <th><span class="glyphicon glyphicon-th-list"></span></th>
                                <th>Code</th>
                                <th>Name</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user->modules as $module)
                                <tr>
                                    <td><a href="{{ route('modules.show', ['id' => $module->id]) }}"><span class="glyphicon glyphicon-chevron-right"></span></a></td>
                                    <td>{{ $module->code }}</td>
                                    <td>{{ $module->name }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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
                                <th>Module</th>
                                <th>Title</th>
                                <th>Comments</th>
                                <th>Created</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user->works->sortBy(function($item){return $item->feedbackCount.'#'.$item->created_at;}) as $work)
                                <tr>
                                    <td><a href="{{ route('works.show', ['id' => $work->id]) }}"><span class="glyphicon glyphicon-chevron-right"></span></a></td>
                                    <td><a href="{{ route('modules.show', ['id' => $work->module->id]) }}">{{ $work->module->code }}</a></td>
                                    <td>{{ $work->title}}</td>
                                    <td>{{ $work->feedbackCount }}</td>
                                    <td>{{ $work->created_at->format('jS F Y H:i:s') }}</td>
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
                    <h4 class="pull-left">Achievements</h4>
                    @permission('users.achievements.give')
                    <div class="input-group pull-right">
                        <button class="btn btn-primary give-achievement">Give Achievement</button>
                    </div>
                    @endpermission
                </div>
                <div class="panel-body">
                    @foreach($user->achievements->sortBy('achievement_id')->chunk(3) as $chunkedAchievements)
                    <div class="row">
                        @foreach($chunkedAchievements as $achievement)
                            <div class="col-md-4">
                                <div class="panel panel-default">
                                    <div class="panel-body text-center {{ $achievement->isUnlocked() ? 'bg-success' : ($achievement->points > 0 ? 'bg-warning' : 'bg-danger') }}">
                                        <img src="{{ asset('img/gamification/' . $achievement->achievement_id) . '.png'}}"  width="150" style="margin: 0" class="img-circle">
                                        <h3>{{ $achievement->details->name }}</h3>
                                        <h4>{{ $achievement->details->description }}</h4>
                                        <h5>Progress: {{ $achievement->isUnlocked() ? 'Unlocked!' : ($achievement->details->points > 1 ? $achievement->points . '/' . $achievement->details->points : 'Locked!') }}</h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')
<script>
    $(function()
    {
        @canedit($user->id, 'users.update')
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
				'{!! BootForm::select('Group', 'role', $role_array) !!}' +
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
        @endcanedit

        @permission('users.achievements.give')
        $('.give-achievement').click(function() {
            bootbox.dialog({
                title: 'Give Achievement',
                message:
                '{!!  BootForm::open()->action(route('users.achievements.give', $user->id))->addClass('bootstrap-modal-form')->id('give_achievement') !!}' +
                '{!! BootForm::select('Achievement', 'achievement', $achievements) !!}' +
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
                            $('#give_achievement').submit();
                            return false;
                        }
                    }
                },
                backdrop: true,
                onEscape: true
            }).init(function() {
                $('#give_achievement').on('submit', function(submission)
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