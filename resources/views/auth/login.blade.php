@extends('layouts.app')

@section('title', 'Login')

@section('content')
    <div class="max-w-md mx-auto">
        <h2 class="text-2xl font-bold mb-4">Login</h2>
        
        <!-- Flash messages for errors or success -->
        @if(session('error'))
            <div class="mb-4 text-red-600">{{ session('error') }}</div>
        @endif

        <!-- Login Form -->
        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="email" class="block">Email</label>
                <input type="email" name="email" id="email" class="w-full p-2 border border-gray-300 rounded" required placeholder="Enter your email" value="{{ old('email') }}">
                @error('email')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>
            
            <div>
                <label for="password" class="block">Password</label>
                <input type="password" name="password" id="password" class="w-full p-2 border border-gray-300 rounded" required placeholder="Enter your password">
                @error('password')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="flex items-center justify-between">
                <div>
                    <input type="checkbox" name="remember" id="remember" class="mr-2">
                    <label for="remember" class="text-sm">Remember me</label>
                </div>
                <div>
                    <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:text-blue-800">Forgot password?</a>
                </div>
            </div>

            <button type="submit" class="w-full p-2 bg-blue-600 text-white rounded hover:bg-blue-700">Login</button>
        </form>

        <p class="mt-4 text-center">
            Don't have an account? <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800">Register</a>
        </p>
    </div>
@endsection
