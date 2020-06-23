@extends('layouts.manage')
@section('title','Permission Management')
@section('description',"Permissions")
@section('content')
    <div class="container" id="content">
        <h1>Permissions</h1>
        @can('Permissions.Create')
        <a href="{{route('permissions.create')}}" class="btn green">Create New Permission</a>
        <br>
        @endcan
        <br>
        <ul class="collapsible">
            <li>
                <div class="collapsible-header"><i class="material-icons">person</i>User Permissions</div>
                <div class="collapsible-body">
                    <table class="responsive-table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Guard</th>
                            <th>Created At</th>
                            @can('Permissions.Delete')
                            <th class="center-align">Settings</th>
                            @endcan
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($perms as $perm)
                            @if($perm->guard_name == 'web')
                                <tr id="perm-{{$perm->id}}">
                                    <td>{{$perm->name}}</td>
                                    <td><span class="badge teal white-text capfirst">{{$perm->guard_name}}</span></td>
                                    <td><span data-position="right"
                                              data-tooltip="{{ \Carbon\Carbon::parse($perm->created_at)->format('n/j/Y g:i A')}}"
                                              class="ts tooltipped">{{\Carbon\Carbon::parse($perm->created_at)->diffForHumans()}}</span>
                                    </td>
                                    @can('Permissions.Delete')
                                    <td class="center-align">
                                        <button onclick="DeletePerm('{{$perm->id}}')" class="btn red"><i
                                                class="material-icons center">delete_sweep</i></button>
                                    </td>
                                    @endcan
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </li>
            <li>
                <div class="collapsible-header"><i class="material-icons">filter_drama</i>API Permissions</div>
                <div class="collapsible-body">
                    <table class="responsive-table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Guard</th>
                            <th>Created At</th>
                            @can('Permissions.Delete')
                            <th class="center-align">Settings</th>
                            @endcan
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($perms as $perm)
                            @if($perm->guard_name == 'api')
                                <tr id="perm-{{$perm->id}}">
                                    <td>{{$perm->name}}</td>
                                    <td><span class="badge teal white-text capfirst">{{$perm->guard_name}}</span></td>
                                    <td><span data-position="right"
                                              data-tooltip="{{ \Carbon\Carbon::parse($perm->created_at)->format('n/j/Y g:i A')}}"
                                              class="ts tooltipped">{{\Carbon\Carbon::parse($perm->created_at)->diffForHumans()}}</span>
                                    </td>
                                    @can('Permissions.Delete')
                                    <td class="center-align">
                                        <button onclick="DeletePerm('{{$perm->id}}')" class="btn red"><i
                                                class="material-icons center">delete_sweep</i></button>
                                    </td>
                                    @endcan
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </li>
        </ul>
        @can('Permissions.Delete')
        <script>
            function DeletePerm(id) {
                axios({
                    method: 'DELETE',
                    url: '/manage/permissions/' + id,
                })
                    .then(function (response) {
                        if (response.data.success) {
                            AlertMaterializeSuccess(response.data.success);
                            $("#perm-" + id).remove();
                        } else {
                            AlertMaterializeError(response.data.error);
                        }
                    });
            }
        </script>
        @endcan
    </div>
    <script>
        const observer = lozad(); // lazy loads elements with default selector as '.lozad'
        observer.observe();
    </script>
@endsection
