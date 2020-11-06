@extends('layouts.manage')
@section('title','Alerts')
@section('description',"Alerts")
@section('content')
    <div class="container" id="content">
        <h2>Alerts</h2>
        @can('Alerts.Create')
            <a href="{{route('alerts.create')}}" class="btn green">Post New Alert</a>
        @endcan
        <div class="section">
            <table class="responsive-table">
                <thead>
                <tr>
                    <th>Message</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th class="center-align">Settings</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($alerts as $alert)
                    <tr id="alert-{{$alert->id}}">
                        <td>{{$alert->message}}</td>
                        <td><span data-position="right"
                                  data-tooltip="{{ \Carbon\Carbon::parse($alert->created_at)->format('n/j/Y g:i A')}}"
                                  class="ts tooltipped">{{\Carbon\Carbon::parse($alert->created_at)->diffForHumans()}}</span>
                        </td>
                        <td><span data-position="right"
                                  data-tooltip="{{ \Carbon\Carbon::parse($alert->updated_at)->format('n/j/Y g:i A')}}"
                                  class="ts tooltipped">{{\Carbon\Carbon::parse($alert->updated_at)->diffForHumans()}}</span>
                        </td>
                        <td class="center-align">
                            @can('Alerts.Delete')
                                <button onclick="RevokeKey('{{$alert->id}}')" data-position="right"
                                        data-tooltip="Revoke Key" class="btn-small red tooltipped"><i
                                        class="material-icons center">delete_sweep</i></button>
                            @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        const observer = lozad(); // lazy loads elements with default selector as '.lozad'
        observer.observe();
    </script>
@endsection
