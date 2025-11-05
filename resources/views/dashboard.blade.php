@extends('layouts.app')

@section('content')
<section class="py-16 bg-gray-50 dark:bg-gray-900">
  <div class="max-w-5xl mx-auto text-center">
    <h1 class="text-4xl font-bold text-gray-800 dark:text-gray-100 mb-4">
      Welcome to your Dashboard
    </h1>
    <p class="text-gray-600 dark:text-gray-400">
      You’re logged in as {{ auth()->user()->name }}.
    </p>
  </div>
</section>
@endsection
