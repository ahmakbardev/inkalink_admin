@extends('layouts.layout')

@section('content')
    <div class="bg-indigo-600 px-8 pt-10 lg:pt-14 pb-16 flex justify-between items-center mb-3">
        <!-- title -->
        <h1 class="text-xl text-white">Kategori</h1>
        <a href="{{ route('categories.create') }}"
            class="btn bg-white text-gray-800 border-gray-600 hover:bg-gray-100 hover:text-gray-800 hover:border-gray-200 active:bg-gray-100 active:text-gray-800 active:border-gray-200 focus:outline-none focus:ring-4 focus:ring-indigo-300">
            Buat Kategori Baru
        </a>
    </div>
    <div class="-mt-12 mx-6 mb-6 grid grid-cols-1 gap-x-6 gap-y-6">
        <div class="">
            <div class="card h-full shadow">
                <!-- heading -->
                <div class="border-b border-gray-300 px-5 py-4">
                </div>

                <div class="relative overflow-x-auto" data-simplebar="" style="max-height: 600px">
                    <!-- table -->
                    <table class="text-left w-full whitespace-nowrap">
                        <thead class="text-gray-700">
                            <tr>
                                <th scope="col" class="border-b bg-gray-100 px-6 py-3">No
                                </th>
                                <th scope="col" class="border-b bg-gray-100 px-6 py-3">Nama Kategori
                                </th>
                                <th scope="col" class="border-b bg-gray-100 px-6 py-3">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($categories->isEmpty())
                                <tr>
                                    <td colspan="3" class="text-center py-3 border-b border-gray-300">Tidak ada data
                                        kategori.</td>
                                </tr>
                            @else
                                @foreach ($categories as $index => $category)
                                    <tr>
                                        <td class="border-b border-gray-300 py-3 px-6 text-left">{{ $index + 1 }}
                                        </td>
                                        <td class="border-b border-gray-300 py-3 px-6 text-left">{{ $category->name }}
                                        </td>
                                        <td class="border-b border-gray-300 py-3 px-6 text-left">
                                            <a href="{{ route('categories.edit', $category->id) }}"
                                                class="inline-flex items-center gap-x-2 bg-indigo-600 text-white border-indigo-600 rounded hover:bg-indigo-800 hover:border-indigo-800 active:bg-indigo-800 active:border-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-300 aspect-square transition-all ease-in-out px-3 py-1"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-title="Edit Kategori">
                                                <i data-feather="edit-2" class="w-4 h-4"></i>
                                            </a>
                                            <button type="button"
                                                class="delete-button inline-flex items-center gap-x-2 bg-red-600 text-white border-red-600 rounded hover:bg-red-800 hover:border-red-800 active:bg-red-800 active:border-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 aspect-square transition-all ease-in-out px-3 py-1"
                                                data-url="{{ route('categories.destroy', $category->id) }}"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                data-bs-title="Hapus Kategori">
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
        <!-- Modal Konfirmasi Hapus -->
        <div id="deleteModal"
            class="fixed inset-0 bg-gray-600 bg-opacity-50 opacity-0 hidden flex items-center justify-center p-4 transition-opacity duration-300 z-10">
            <div
                class="opacity-0 transition-all transform -translate-y-1/2 duration-300 bg-white rounded-lg shadow-xl p-6 w-full max-w-md m-auto top-1/2">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Konfirmasi Hapus</h3>
                <p class="text-gray-600">Apakah Anda yakin ingin menghapus kategori ini?</p>
                <div class="text-right space-x-2 mt-4">
                    <button id="cancelButton"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 rounded px-4 py-2">Batal</button>
                    <button id="confirmButton"
                        class="bg-red-600 hover:bg-red-700 text-white rounded px-4 py-2">Hapus</button>
                </div>
            </div>
        </div>

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
                            modalContent.style.transform =
                            'translateY(-50%)'; // Menyesuaikan transform untuk pusat vertikal
                            modalContent.style.opacity = '1';
                        }, 10);
                    });
                });

                cancelButton.addEventListener('click', () => {
                    modalContent.style.opacity = '0';
                    setTimeout(() => {
                        deleteModal.style.opacity = '0';
                        modalContent.style.transform =
                        'translateY(-60%)'; // Menyesuaikan posisi saat menghilang
                        setTimeout(() => {
                            deleteModal.classList.add('hidden');
                        }, 300); // Delay to allow opacity transition
                    }, 150); // Start hiding process after short delay
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

    </div>
@endsection
