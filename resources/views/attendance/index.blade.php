@extends('layouts.app')

@section('title', 'Attendance')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Attendance</h2>
    <div class="space-y-4">
        <!-- Add Attendance Form Here -->
        <form action="{{ route('staff.attendance.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="user" class="block">User</label>
                <select name="user" id="user" class="w-full p-2 border border-gray-300 rounded" required>
                    <option value="{{$user->id}}">{{$user -> name}}</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="attendance_type" class="block">Attendance Type</label>
                <select name="attendance_type" id="attendance_type" class="w-full p-2 border border-gray-300 rounded" required>
                    <option value="{{$user->role}}">{{$user->role}}</option>
                </select>
            </div>
            <button type="submit" class="w-full py-2 bg-blue-600 text-white rounded">Add Attendance</button>
        </form>
    </div>
@endsection
