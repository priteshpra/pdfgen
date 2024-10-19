@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">{{ __('View State') }}</div>

    <div class="card-body">

        <a href="{{ route('admin.state.index') }}" class="btn btn-light">Back to List</a>

        <br /><br />



        <table class="table table-borderless">

            <tr>
                <th>ID</th>
                <td>{{ $user->StateID }}</td>
            </tr>
            <tr>
                <th>State Name</th>
                <td>{{ $user->State }}</td>
            </tr>

        </table>




    </div>
</div>

@endsection