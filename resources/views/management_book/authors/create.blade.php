@extends('layouts.app')

@section('title', 'create penulis')
@section('content')
    <div class="max-w-4xl mx-auto mt-10 p-6 bg-white border border-gray-200 rounded-lg shadow-lg">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Tambah Author Baru</h2>

        <form action="{{ route('authors.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Author</label>
                <input type="text" name="name" id="name"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-[4px] shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('name') border-red-500 @enderror"
                    value="{{ old('name') }}">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="bio" class="block text-sm font-medium text-gray-700">Bio</label>
                <textarea name="bio" id="bio" rows="4"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-[4px] shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 @error('bio') border-red-500 @enderror">{{ old('bio') }}</textarea>
                @error('bio')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <button type="submit"
                    class="px-6 py-2 bg-amber-700 text-white rounded-[4px] shadow-md hover:bg-blue-700 focus:outline-none focus:ring-1 focus:ring-indigo-500">
                    Tambah Author
                </button>
                <a href="{{ route('authors.index') }}"
                    class="px-6 py-2 bg-red-400 text-white rounded-[4px] shadow-md hover:bg-red-600 focus:outline-none focus:ring-1 focus:ring-red-400">Kembali</a>
            </div>
        </form>
    </div>
@endsection
