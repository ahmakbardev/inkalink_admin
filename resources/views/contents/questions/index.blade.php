@extends('layouts.layout')

@section('content')
    <div class="bg-indigo-600 px-8 pt-10 lg:pt-14 pb-16 flex justify-between items-center mb-3">
        <!-- title -->
        <h1 class="text-xl text-white">Soal Test</h1>
        <a href="{{ route('questions.create') }}"
            class="btn bg-white text-gray-800 border-gray-600 hover:bg-gray-100 hover:text-gray-800 hover:border-gray-200 active:bg-gray-100 active:text-gray-800 active:border-gray-200 focus:outline-none focus:ring-4 focus:ring-indigo-300">
            Buat Soal Test Baru
        </a>
    </div>
    <div class="mx-6 mb-6">
        <div class="card h-full shadow">
            <!-- table -->
            <div class="relative overflow-x-auto" data-simplebar style="max-height: 600px">
                <table class="text-left w-full whitespace-nowrap">
                    <thead class="text-gray-700 bg-gray-100">
                        <tr>
                            <th scope="col" class="px-6 py-3">No</th>
                            <th scope="col" class="px-6 py-3">Kategori</th>
                            <th scope="col" class="px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($questions->isEmpty())
                            <tr>
                                <td colspan="4" class="text-center py-3 border-b border-gray-300">Tidak ada data soal
                                    test.</td>
                            </tr>
                        @else
                            @foreach ($questions as $index => $question)
                                <tr>
                                    <td class="border-b border-gray-300 py-3 px-6">{{ $index + 1 }}</td>
                                    <td class="border-b border-gray-300 py-3 px-6">{{ $question->category->name }}</td>
                                    <td class="border-b border-gray-300 py-3 px-6">
                                        <a href="{{ route('questions.edit', $question->id) }}"
                                            class="inline-flex items-center gap-x-2 bg-indigo-600 text-white border-indigo-600 rounded hover:bg-indigo-800 hover:border-indigo-800 active:bg-indigo-800 active:border-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-300 aspect-square transition-all ease-in-out px-3 py-1">
                                            <i data-feather="edit-2" class="w-4 h-4"></i>
                                        </a>
                                        <button type="button"
                                            class="delete-button inline-flex items-center gap-x-2 bg-red-600 text-white border-red-600 rounded hover:bg-red-800 hover:border-red-800 active:bg-red-800 active:border-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 aspect-square transition-all ease-in-out px-3 py-1"
                                            data-url="{{ route('questions.destroy', $question->id) }}"
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-title="Hapus Soal Test">
                                            <i data-feather="trash-2" class="w-4 h-4"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @include('contents.questions.components.delete-modal')

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const deleteButtons = document.querySelectorAll('.delete-button');
            const deleteModal = document.getElementById('deleteModal');
            const modalContent = deleteModal.querySelector('.rounded-lg');
            const cancelButton = document.getElementById('cancelButton');
            const confirmButton = document.getElementById('confirmButton');
            let deleteUrl = '';

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    deleteUrl = this.dataset.url;
                    deleteModal.classList.remove('hidden');
                    setTimeout(() => {
                        deleteModal.style.opacity = '1';
                        modalContent.style.transform = 'translateY(0)';
                        modalContent.style.opacity = '1';
                    }, 10);
                });
            });

            cancelButton.addEventListener('click', () => {
                modalContent.style.opacity = '0';
                modalContent.style.transform = 'translateY(-10px)';
                setTimeout(() => {
                    deleteModal.style.opacity = '0';
                    setTimeout(() => {
                        deleteModal.classList.add('hidden');
                    }, 300);
                }, 150);
            });

            confirmButton.addEventListener('click', () => {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = deleteUrl;
                form.innerHTML = `<input type="hidden" name="_token" value="{{ csrf_token() }}">
                                  <input type="hidden" name="_method" value="DELETE">`;
                document.body.appendChild(form);
                form.submit();
            });
        });
    </script>
@endsection
