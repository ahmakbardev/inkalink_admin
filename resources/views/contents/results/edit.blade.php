@extends('layouts.layout')

@section('content')
    <div class="bg-indigo-600 px-8 pt-10 lg:pt-14 pb-16 flex justify-between items-center mb-3">
        <!-- title -->
        <h1 class="text-xl text-white">Edit Hasil Kepribadian</h1>
    </div>
    <div class="-mt-12 mx-6 mb-6 grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-1 xl:grid-cols-1">
        <div class="xl:col-span-1">
            <div class="card h-full shadow">
                <!-- heading -->
                <div class="border-b border-gray-300 px-5 py-4">
                    <h2 class="font-semibold text-gray-700">Form Edit Hasil Kepribadian</h2>
                </div>

                <div class="p-6">
                    <form action="{{ route('results.update', $result->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <!-- Kategori Input -->
                        <div class="mb-6">
                            <label for="category_select" class="mb-2 block text-gray-800">Kategori (Pilih 3)</label>
                            <div id="selected_categories" class="mb-3">
                                @foreach ($result->category_ids as $categoryId)
                                    @php
                                        $category = \App\Models\Category::find($categoryId);
                                    @endphp
                                    @if ($category)
                                        <span
                                            class="bg-indigo-200 px-2 py-1 text-indigo-700 text-sm font-medium rounded-md inline-block whitespace-nowrap text-center mr-2 mb-2">
                                            {{ $category->name }} <button type="button"
                                                class="ml-2 text-indigo-700 font-semibold"
                                                onclick="removeCategory('{{ $categoryId }}', this)">✕</button>
                                        </span>
                                    @endif
                                @endforeach
                            </div>
                            <input type="hidden" id="category_ids" name="category_ids"
                                value="{{ json_encode($result->category_ids) }}">

                            <select id="category_select"
                                class="border border-gray-300 text-gray-900 rounded focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2 px-3">
                                <option value="" selected disabled>Pilih Kategori</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Kode Input -->
                        <div class="mb-6">
                            <label for="code" class="mb-2 block text-gray-800">Kode</label>
                            <input type="text" id="code" name="code"
                                class="border border-gray-300 text-gray-900 rounded focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2 px-3"
                                placeholder="Kode" value="{{ $result->code }}" required />
                        </div>
                        <!-- Deskripsi Input -->
                        <div class="mb-6">
                            <label for="description" class="mb-2 block text-gray-800">Deskripsi</label>
                            <textarea id="description" name="description"
                                class="border border-gray-300 text-gray-900 rounded focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2 px-3"
                                placeholder="Deskripsi" required>{{ $result->description }}</textarea>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit"
                            class="btn gap-x-2 bg-indigo-600 text-white border-indigo-600 disabled:opacity-50 disabled:pointer-events-none hover:bg-indigo-800 hover:border-indigo-800 active:bg-indigo-800 active:border-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-300">
                            Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categorySelect = document.getElementById('category_select');
            const selectedCategories = document.getElementById('selected_categories');
            const categoryIdsInput = document.getElementById('category_ids');

            let selectedCategoryIds = JSON.parse(categoryIdsInput.value);

            categorySelect.addEventListener('change', function() {
                const selectedOption = this.options[this.selectedIndex];
                const selectedCategoryId = this.value;

                if (selectedCategoryId && !selectedCategoryIds.includes(selectedCategoryId)) {
                    selectedCategoryIds.push(selectedCategoryId);

                    const badge = document.createElement('span');
                    badge.className =
                        'bg-indigo-200 px-2 py-1 text-indigo-700 text-sm font-medium rounded-md inline-block whitespace-nowrap text-center mr-2 mb-2';
                    badge.innerHTML =
                        `${selectedOption.text} <button type="button" class="ml-2 text-indigo-700 font-semibold" onclick="removeCategory('${selectedCategoryId}', this)">✕</button>`;
                    selectedCategories.appendChild(badge);

                    updateCategoryIdsInput();
                }

                this.selectedIndex = 0; // Reset select option to placeholder
            });

            window.removeCategory = function(categoryId, button) {
                selectedCategoryIds = selectedCategoryIds.filter(id => id !== categoryId);
                button.parentElement.remove();
                updateCategoryIdsInput();
            }

            function updateCategoryIdsInput() {
                categoryIdsInput.value = JSON.stringify(selectedCategoryIds); // Send as JSON
            }
        });
    </script>
@endsection
