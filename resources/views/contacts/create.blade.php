@extends('layouts.app')

@section('content')
    <div class="py-8">
        <div class="max-w-md mx-auto">
            <!-- Card Container -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <!-- Card Header -->
                <div class="px-6 py-4 border-b border-gray-200">
                    <h1 class="text-2xl font-bold text-gray-800">Create New Contact</h1>
                </div>

                <!-- Error Messages -->
                @include('partials.errors')

                <!-- Card Body - Form -->
                <form action="{{ route('contacts.store') }}" method="POST" class="px-6 py-4"
                    onsubmit="return confirm('Are you sure you want to create this contact?');">
                    @csrf
                    
                    <!-- Name Field -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-medium mb-2">Name <span class="text-red-500">*</span></label>
                        <div class="flex items-center border border-gray-300 rounded-md">
                            <div class="px-3 py-2 text-gray-400">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="text" name="name" value="{{ old('name') }}" 
                                class="w-full py-2 px-3 focus:outline-none" required>
                        </div>
                    </div>

                    <!-- Email Field -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-medium mb-2">Email <span class="text-red-500">*</span></label>
                        <div class="flex items-center border border-gray-300 rounded-md">
                            <div class="px-3 py-2 text-gray-400">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                            </div>
                            <input type="email" name="email" value="{{ old('email') }}" 
                                class="w-full py-2 px-3 focus:outline-none" required>
                        </div>
                    </div>

                    <!-- Phone Field -->
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-medium mb-2">Phone <span class="text-red-500">*</span></label>
                        <div class="flex items-center border border-gray-300 rounded-md">
                            <div class="px-3 py-2 text-gray-400">
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                </svg>
                            </div>
                            <input type="text" name="phone" value="{{ old('phone') }}" 
                                class="w-full py-2 px-3 focus:outline-none" required>
                        </div>
                    </div>

                    <!-- Message Field -->
                    <div class="mb-6">
                        <label class="block text-gray-700 text-sm font-medium mb-2">Message <span class="text-red-500">*</span></label>
                        <textarea name="message" rows="3" 
                            class="w-full border border-gray-300 rounded-md p-3 focus:outline-none" required>{{ old('message') }}</textarea>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-between border-t border-gray-200 pt-4">
                        <a href="{{ route('contacts.index') }}" 
                            class="px-4 py-2 text-gray-700 border border-gray-300 rounded-md hover:bg-gray-50 transition">
                            Cancel
                        </a>
                        <button type="submit" 
                            class="px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700 transition">
                            Create Contact
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection