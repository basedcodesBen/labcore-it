<!-- resources/views/components/sidebar/dosen-sidebar.blade.php -->
<aside class="w-64 bg-gray-800 text-white h-full">
    <div class="p-4">
        <h2 class="text-xl font-bold">Dosen Dashboard</h2>
    </div>
    <ul class="space-y-2">
        <li><a href="{{ route('dosen.dashboard') }}" class="block py-2 px-4 hover:bg-gray-700">Dashboard</a></li>
        {{-- <li><a href="{{ route('dosen.rooms') }}" class="block py-2 px-4 hover:bg-gray-700">Rooms</a></li> --}}
        <li><a href="{{ route('dosen.room-reservations.index') }}" class="block py-2 px-4 hover:bg-gray-700">Reservations</a></li>
    </ul>
</aside>
