@extends('layouts.layout')

@section('content')
    <div class="bg-indigo-600 px-8 pt-10 lg:pt-14 pb-16 flex justify-between items-center mb-3">
        <!-- title -->
        <h1 class="text-xl text-white">Edit Tipe Kepribadian</h1>
    </div>
    <div class="-mt-12 mx-6 mb-6 grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-1 xl:grid-cols-1">
        <div class="xl:col-span-1">
            <div class="card h-full shadow">
                <!-- heading -->
                <div class="border-b border-gray-300 px-5 py-4">
                    <h2 class="font-semibold text-gray-700">Form Edit Tipe Kepribadian</h2>
                </div>

                <div class="p-6">
                    <form action="{{ route('personality_types.update', $personalityType->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <!-- Kategori Select -->
                        <div class="mb-6">
                            <label for="category_id" class="mb-2 block text-gray-800">Kategori</label>
                            <select id="category_id" name="category_id"
                                class="border border-gray-300 text-gray-900 rounded focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2 px-3"
                                required>
                                <option value="" disabled selected>Pilih Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $category->id == $personalityType->category_id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Nama Tipe Kepribadian Input -->
                        <div class="mb-6">
                            <label for="name" class="mb-2 block text-gray-800">Nama Tipe Kepribadian</label>
                            <input type="text" id="name" name="name"
                                class="border border-gray-300 text-gray-900 rounded focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2 px-3"
                                placeholder="Nama Tipe Kepribadian" value="{{ $personalityType->name }}" required />
                        </div>

                        <!-- Deskripsi Tipe Kepribadian Input -->
                        <div class="mb-6">
                            <label for="description" class="mb-2 block text-gray-800">Deskripsi</label>
                            <textarea id="description" name="description"
                                class="border border-gray-300 text-gray-900 rounded focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2 px-3"
                                placeholder="Deskripsi Tipe Kepribadian" required rows="5">{{ $personalityType->description }}</textarea>
                        </div>

                        <!-- Gambar Tipe Kepribadian Input -->
                        <div class="mb-6">
                            <label for="image" class="mb-2 block text-gray-800">Gambar (Opsional)</label>
                            @if ($personalityType->image)
                                <div class="mb-2">
                                    <img src="{{ Storage::url($personalityType->image) }}" alt="Image"
                                        class="w-20 h-20 rounded">
                                </div>
                            @endif
                            <input type="file" id="image" name="image"
                                class="border border-gray-300 text-gray-900 rounded focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2 px-3"
                                accept="image/*" />
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="btn gap-x-2 bg-indigo-600 text-white border-indigo-600 disabled:opacity-50 disabled:pointer-events-none hover:bg-indigo-800 hover:border-indigo-800 active:bg-indigo-800 active:border-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-300">
                            Update Tipe Kepribadian
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
