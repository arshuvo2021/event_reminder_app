@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Import Events</h2>
    <form action="{{ route('events.import.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="file">Choose CSV/Excel File</label>
            <input type="file" class="form-control" name="file" id="file" required>
        </div>
        <button type="submit" class="btn btn-primary">Import</button>
    </form>
</div>
@endsection
