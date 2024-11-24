@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Manage Admins</h1>

    <!-- Current Admins -->
    <h2>Current Admins</h2>
    <table class="table">
        <thead>
            <tr>
                <th>FirstName</th>
                <th>LastName</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($admins as $admin)
                <tr>
                    <td>{{ $admin->FirstName }}</td>
                    <td>{{ $admin->LastName }}</td>
                    <td>{{ $admin->email }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Assign Admin Role -->
    <h2>Assign Admin Role</h2>
    <form action="{{ route('admin.assignRole') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="user_id">Select User</label>
            <select id="user_id" name="user_id" class="form-control">
                @foreach ($customers as $customer)
                    <option value="{{ $customer->id }}">{{ $customer->name }} - {{ $customer->email }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Assign Admin Role</button>
    </form>
</div>
@endsection
