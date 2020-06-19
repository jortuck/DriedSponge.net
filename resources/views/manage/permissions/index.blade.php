@extends('layouts.manage')
@section('title','Permission Management')
@section('description',"Permissions")
@section('content')
    <div class="container" id="content">
        <h1>Permissions</h1>
        <a href="{{route('permissions.create')}}" class="btn green">Create New Permission</a>
        <br>
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
                            <th class="center-align">Settings</th>
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
                                    <td class="center-align">
                                        <button onclick="DeletePerm('{{$perm->id}}')" class="btn red"><i
                                                class="material-icons center">delete_sweep</i></button>
                                    </td>
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
                            <th class="center-align">Settings</th>
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
                                    <td class="center-align">
                                        <button onclick="DeletePerm('{{$perm->id}}')" class="btn red"><i
                                                class="material-icons center">delete_sweep</i></button>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </li>
        </ul>
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
    </div>
    <script>
        const observer = lozad(); // lazy loads elements with default selector as '.lozad'
        observer.observe();
    </script>
@endsection
