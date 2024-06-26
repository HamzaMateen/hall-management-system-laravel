@extends('layouts.app')

@section('content')
<div class="bg-gray-100 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden">
            <div class="bg-gradient-to-r from-indigo-600 to-blue-500 text-white p-6">
                <h2 class="text-4xl font-bold">{{ $hall->type }} - Details</h2>
            </div>
            <div class="p-6 sm:p-8">
                <div class="flex flex-col md:flex-row items-start justify-between mb-8">
                    <div class="mb-6 md:mb-0 md:w-1/2">
                        <img src="{{ asset('storage/halls/' . $hall->image) }}" alt="{{ $hall->type }}" class="w-full h-auto rounded-lg shadow-lg">
                    </div>
                    <div class="md:w-1/2 md:ml-8">
                        <div class="text-gray-700 space-y-6">
                            <p class="text-2xl"><strong>Name:</strong> {{ $hall->type }}</p>
                            <p class="text-2xl"><strong>Capacity:</strong> {{ $hall->capacity }}</p>
                            <p class="text-2xl"><strong>Location:</strong> {{ $hall->location }}</p>
                            <p class="text-2xl"><strong>Price:</strong> ${{ $hall->price }}</p>
                            <p class="text-2xl"><strong>Availability:</strong> 
                                <span class="px-3 py-1 rounded-full {{ $hall->availability ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                                    {{ $hall->availability ? 'Available' : 'Not Available' }}
                                </span>
                            </p>
                        </div>
                        <div class="mt-8 flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-4">
                            <a href="{{ route('bookings.create', ['hall_id' => $hall->id]) }}" class="bg-blue-600 hover:bg-blue-800 text-white font-bold py-3 px-6 rounded shadow-md">Book Now</a>
                            @if (auth()->check() && auth()->user()->id === $hall->user_id)
                                <a href="{{ route('halls.edit', $hall->id) }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-3 px-6 rounded shadow-md">Edit</a>
                                <form action="{{ route('halls.destroy', $hall->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 hover:bg-red-800 text-white font-bold py-3 px-6 rounded shadow-md">Delete</button>
                                </form>
                            @endif
                            <a href="{{ route('halls.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-3 px-6 rounded shadow-md">Back to Halls</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
