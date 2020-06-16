@extends('layouts.manage')
@section('title','Api Keys')
@section('description',"Manage api keys here")
@section('content')
    <div class="container" id="content">
        <h2>All Api Keys</h2>

        <a href="{{route('api.create')}}" class="btn green">Create New Api Key</a>
        <div class="section">
            <table class="responsive-table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Key</th>
                    <th>Created At</th>
                    <th>Settings</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($apikeys as $key)
                    <tr id="perm-{{$key->id}}">
                        <td>{{$key->name}}</td>
                        <td><span class="click-to-reveal badge white-text darken-4-5 pointer" data-revealed="false"
                                  data-reveal-content="{{$key->key}}">Click to reveal</span> <span
                                class="blue-text pointer" onclick="Copy('{{$key->key}}')">(Copy)</span></td>
                        <td><span data-position="right"
                                  data-tooltip="{{ \Carbon\Carbon::parse($key->created_at)->format('n/j/Y g:i A')}}"
                                  class="ts tooltipped">{{\Carbon\Carbon::parse($key->created_at)->diffForHumans()}}</span>
                        </td>
                        <td>
                            <button onclick="DeletePerm('{{$key->id}}')" class="btn red"><i
                                    class="material-icons center">delete_sweep</i></button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
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
