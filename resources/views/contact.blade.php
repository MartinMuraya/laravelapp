@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-16 px-6">
  <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-2xl p-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Contact Us</h1>
    <p class="text-gray-600 text-center mb-8">
      Have questions or feedback? We’d love to hear from you.
    </p>

    @if(session('success'))
      <p class="text-green-600 text-center mb-4">{{ session('success') }}</p>
    @endif

    <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
      @csrf

      <div>
        <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}"
               class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50" 
               placeholder="Enter Your Name">
        @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

      <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}"
               class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50" 
               placeholder="Enter Your Email">
        @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

      <div>
        <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
        <textarea id="message" name="message" rows="4"
                  class="w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-400 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                  placeholder="Your message...">{{ old('message') }}</textarea>
        @error('message') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

      <div class="text-center">
        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
          Send Message
        </button>
      </div>
    </form>
  </div>
</div>
@endsection
