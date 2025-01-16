@extends('layouts.app')

@section('title', 'Dosen Dashboard')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-4">Dosen Dashboard</h1>
        <p>Welcome, Dosen! Here you can manage your classes and attendance.</p>
        <!-- You can add more functionality for the dosen dashboard here -->
    </div>
    <div class="container mt-5 text-center">
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

            @if(session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
           @endif
    </div>
@endsection
