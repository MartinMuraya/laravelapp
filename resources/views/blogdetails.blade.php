@extends('layouts.app')

@section('content')
<section class="bg-gray-50 dark:bg-gray-900 py-20">
  <div class="max-w-4xl mx-auto px-4">
    <div class="bg-white dark:bg-gray-800 shadow-lg rounded-2xl p-8">
      <h1 class="text-3xl font-bold mb-4 text-gray-800 dark:text-gray-100">{{ $blog->title }}</h1>
      <p class="text-sm text-gray-500 mb-6">Published on {{ $blog->created_at->format('M d, Y') }}</p>
      <p class="text-gray-700 dark:text-gray-300 leading-relaxed">{{ $blog->content }}</p>
    </div>
  </div>
</section>
@endsection
