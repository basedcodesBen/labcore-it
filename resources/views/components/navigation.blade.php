<nav class="bg-gray-800 text-white p-4">
    <div class="container mx-auto flex justify-between items-center">
        @if (Auth::check())
        <a href="{{ route(auth()->user()->role . '.dashboard') }}" class="text-xl font-bold text-center mb-8">LabCore IT</a>
        @else
            <a href="{{ route('login') }}" class="text-xl font-bold text-center mb-8">LabCore IT</a>
        @endif
        <div class="space-x-4">
            @if (Auth::check())
                <a href="{{ route('logout') }}" class="px-4 py-2 bg-red-600 rounded" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @else
                <a href="{{ route('login') }}" class="px-4 py-2 bg-blue-600 rounded">Login</a>
            @endif
        </div>
    </div>
</nav>
