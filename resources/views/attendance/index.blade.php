@extends('layouts.app')

@section('title', 'Attendance')

@section('content')
    <h2 class="text-2xl font-bold mb-4">Attendance</h2>
    <div class="space-y-4">
        <!-- Add Attendance Form Here -->
        <form action="{{ $user->role === 'dosen' ? route('dosen.attendance.store') : route('staff.attendance.store')}}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="user" class="block">User</label>
                <select name="user" id="user" class="w-full p-2 border border-gray-300 rounded" required>
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="attendance_type" class="block">Attendance Type</label>
                <select name="attendance_type" id="attendance_type" class="w-full p-2 border border-gray-300 rounded" required>
                    <option value="{{ $user->role }}">{{ $user->role }}</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="clock_in" class="block">Clock In</label>
                <input type="time" name="clock_in" id="clock_in" class="w-full p-2 border border-gray-300 rounded" required>
            </div>

            <!-- Conditional Input for Dosen -->
            @if ($user->role === 'dosen')
                <div class="mb-4">
                    <label for="room" class="block">Room</label>
                    <select name="room" id="room" class="w-full p-2 border border-gray-300 rounded" required>
                        @foreach ($rooms as $room)    
                            <option value="{{$room->id}}">{{ $room->name }}</option>
                        @endforeach
                    </select>
                </div>
            @endif

            <button type="submit" class="w-full py-2 bg-blue-600 text-white rounded">Add Attendance</button>
        </form>
    </div>
@endsection
