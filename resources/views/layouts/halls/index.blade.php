<!-- resources/views/halls/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8 bg-gray-50">
    <h1 class="text-4xl font-bold text-gray-800 mb-8">Halls</h1>
    <a href="{{ route('halls.create') }}" class="bg-indigo-600 hover:bg-indigo-800 text-white font-semibold py-3 px-6 rounded mb-8 inline-block shadow-lg">Register a New Hall</a>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($halls as $hall)
            <div class="bg-white rounded-lg overflow-hidden shadow-lg hover:shadow-2xl transform hover:-translate-y-1 transition-all duration-300">
                <img src="{{ $hall->image_url }}" class="w-full h-48 object-cover" alt="{{ $hall->type }}">
                <div class="p-6">
                    <h2 class="font-bold text-2xl text-gray-900 mb-2">{{ $hall->type }}</h2>
                    <p class="text-gray-600 mb-2"><span class="font-semibold">Capacity:</span> {{ $hall->capacity }}</p>
                    <p class="text-gray-600 mb-2"><span class="font-semibold">Location:</span> {{ $hall->location }}</p>
                    <p class="text-gray-600 mb-2"><span class="font-semibold">Price:</span> ${{ $hall->price }}</p>
                    <p class="text-gray-600 mb-4"><span class="font-semibold">Availability:</span> 
                        <span class="px-2 py-1 rounded-full {{ $hall->availability ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                            {{ $hall->availability ? 'Available' : 'Not Available' }}
                        </span>
                    </p>
                    <a href="{{ route('halls.show', $hall->id) }}" class="bg-indigo-600 hover:bg-indigo-800 text-white font-semibold py-2 px-4 rounded shadow-md inline-block transition duration-300">View Details</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
