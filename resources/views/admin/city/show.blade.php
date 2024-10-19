@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">{{ __('View City') }}</div>

    <div class="card-body">

        <a href="{{ route('admin.city.index') }}" class="btn btn-light">Back to List</a>

        <br /><br />



        <table class="table table-borderless">

            <tr>
                <th>ID</th>
                <td>{{ $user->CityID }}</td>
            </tr>
            <tr>
                <th>City Name</th>
                <td>{{ $user->City }}</td>
            </tr>


        </table>




    </div>
</div>

@endsection