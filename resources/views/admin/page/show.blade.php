@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">{{ __('View Page') }}</div>

    <div class="card-body">

        <a href="{{ route('admin.page.index') }}" class="btn btn-light">Back to List</a>

        <br /><br />

        <table class="table table-borderless">
            <tr>
                <th>ID</th>
                <td>{{ $user->PageID }}</td>
            </tr>
            <tr>
                <th>Name</th>
                <td>{{ $user->PageName }}</td>
            </tr>
        </table>
    </div>
</div>

@endsection