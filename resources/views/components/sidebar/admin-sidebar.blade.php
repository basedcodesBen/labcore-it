<!-- resources/views/components/sidebar/admin-sidebar.blade.php -->
<aside class="w-64 bg-gray-800 text-white h-full">
    <div class="p-4">
        <h2 class="text-xl font-bold">Admin Dashboard</h2>
    </div>
    <ul class="space-y-2">
        <li><a href="{{ route('admin.dashboard') }}" class="block py-2 px-4 hover:bg-gray-700">Dashboard</a></li>
        <li><a href="{{ route('admin.users') }}" class="block py-2 px-4 hover:bg-gray-700">Users</a></li>
        <li><a href="{{ route('admin.rooms') }}" class="block py-2 px-4 hover:bg-gray-700">Rooms</a></li>
        <li><a href="{{ route('admin.inventory') }}" class="block py-2 px-4 hover:bg-gray-700">Inventory</a></li>
        <li><a href="{{ route('admin.reservations') }}" class="block py-2 px-4 hover:bg-gray-700">Reservations</a></li>
        <li><a href="{{ route('admin.attendance') }}" class="block py-2 px-4 hover:bg-gray-700">Attendance</a></li>
    </ul>
</aside>
