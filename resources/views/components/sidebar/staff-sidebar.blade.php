<!-- resources/views/components/sidebar/staff-sidebar.blade.php -->
<aside class="w-64 bg-gray-800 text-white h-full">
    <div class="p-4">
        <h2 class="text-xl font-bold">Staff Dashboard</h2>
    </div>
    <ul class="space-y-2">
        <li><a href="{{ route('staff.dashboard') }}" class="block py-2 px-4 hover:bg-gray-700">Dashboard</a></li>
        {{-- <li><a href="{{ route('staff.rooms') }}" class="block py-2 px-4 hover:bg-gray-700">Rooms</a></li>
        <li><a href="{{ route('staff.inventory') }}" class="block py-2 px-4 hover:bg-gray-700">Inventory</a></li> --}}
        <li><a href="{{ route('staff.room-reservations.index') }}" class="block py-2 px-4 hover:bg-gray-700">Reservations</a></li>
        <li><a href="{{ route('staff.attendance') }}" class="block py-2 px-4 hover:bg-gray-700">Absensi</a></li>
    </ul>
</aside>
