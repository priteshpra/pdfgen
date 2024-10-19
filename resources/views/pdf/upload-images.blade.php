@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header">{{ __('Upload Images') }}</div>

    <div class="card-body">

        <form action="{{ url('/admin/upload-images') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="images">Select images:</label>
            <input type="file" name="images[]" id="images" multiple accept="image/*">
            <br><br>
            <button type="submit">Upload and Convert to PDF</button>
        </form>

        @if($errors->any())
        <div style="color:red;">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</div>

@endsection