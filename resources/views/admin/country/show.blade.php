@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">{{ __('View Country') }}</div>

    <div class="card-body">

        <a href="{{ route('admin.country.index') }}" class="btn btn-light">Back to List</a>

        <br /><br />



        <table class="table table-borderless">

            <tr>
                <th>ID</th>
                <td>{{ $user->CountryID }}</td>
            </tr>
            <tr>
                <th>Name</th>
                <td>{{ $user->Country }}</td>
            </tr>

        </table>




    </div>
</div>

@endsection