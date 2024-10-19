@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header">{{ __('View Cms') }}</div>

    <div class="card-body">

        <a href="{{ route('admin.cms.index') }}" class="btn btn-light">Back to List</a>

        <br /><br />



        <table class="table table-borderless">

            <tr>
                <th>ID</th>
                <td>{{ $user->CMSID }}</td>
            </tr>
            <tr>
                <th>Cms Name</th>
                <td>{{ $user->State }}</td>
            </tr>

        </table>




    </div>
</div>

@endsection