@extends('layouts.app')

@section('content')
    <div class="py-8">
        <div class="max-w-md mx-auto">
            <!-- Card Container -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <!-- Card Header -->
                <div class="px-6 py-4 border-b border-gray-200">
                    <h1 class="text-2xl font-bold text-gray-800">Contact Details</h1>
                </div>

                <!-- Card Body - Content -->
                <div class="px-6 py-4 space-y-4">
                    <div class="flex items-start">
                        <div class="w-1/3 text-gray-700 font-medium">ID:</div>
                        <div class="w-2/3">{{ $contact['id'] }}</div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="w-1/3 text-gray-700 font-medium">Name:</div>
                        <div class="w-2/3">{{ $contact['name'] }}</div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="w-1/3 text-gray-700 font-medium">Email:</div>
                        <div class="w-2/3">{{ $contact['email'] }}</div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="w-1/3 text-gray-700 font-medium">Phone:</div>
                        <div class="w-2/3">{{ $contact['phone'] }}</div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="w-1/3 text-gray-700 font-medium">Message:</div>
                        <div class="w-2/3">{{ $contact['message'] }}</div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="w-1/3 text-gray-700 font-medium">Created At:</div>
                        <div class="w-2/3">{{ $contact['created_at'] }}</div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="w-1/3 text-gray-700 font-medium">Updated At:</div>
                        <div class="w-2/3">{{ $contact['updated_at'] }}</div>
                    </div>
                </div>

                <!-- Card Footer - Actions -->
                <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
                    <a href="{{ route('contacts.index') }}" 
                       class="px-4 py-2 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50 transition">
                        Back
                    </a>
                    <a href="{{ route('contacts.edit', $contact['id']) }}" 
                       class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700 transition">
                        Edit
                    </a>
                    <form action="{{ route('contacts.destroy', $contact['id']) }}" method="POST" 
                          onsubmit="return confirm('Are you sure you want to delete this contact?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection