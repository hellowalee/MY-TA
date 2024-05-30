@extends('template-wpadmin')
@section('navbar_asset','active')
@section('main')
<div class="container">
    <h1>Edit User</h1>
    <form action="/admin/user/update/{{ $user->id }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
        </div>
        <div class="mb-3">
            <label for="isAdmin" class="form-label">Admin</label>
            <select class="form-select" id="isAdmin" name="isAdmin" required>
                <option value="0" {{ $user->isAdmin == 0 ? 'selected' : '' }}>No</option>
                <option value="1" {{ $user->isAdmin == 1 ? 'selected' : '' }}>Yes</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Update User</button>
    </form>
</div>
@endsection
