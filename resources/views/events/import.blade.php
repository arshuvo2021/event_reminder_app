@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Import Events</h2>

    <!-- Success Message -->
    @if(session('success'))
        <div id="success-message" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('events.import.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="file">Choose CSV/Excel File</label>
            <input type="file" class="form-control" name="file" id="file" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Import</button>
    </form>
</div>

<script>
    setTimeout(() => {
        let successMessage = document.getElementById('success-message');
        if (successMessage) {
            successMessage.style.transition = "opacity 0.5s";
            successMessage.style.opacity = "0";
            setTimeout(() => successMessage.remove(), 500); // Remove it after fade out
        }
    }, 3000);
</script>

@endsection
