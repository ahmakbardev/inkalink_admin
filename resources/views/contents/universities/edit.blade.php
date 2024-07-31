@extends('layouts.layout')

@section('content')
    <div class="bg-indigo-600 px-8 pt-10 lg:pt-14 pb-16 flex justify-between items-center mb-3">
        <h1 class="text-xl text-white">Edit Universitas</h1>
    </div>
    <div class="-mt-12 mx-6 mb-6">
        <div class="card h-full shadow">
            <div class="border-b border-gray-300 px-5 py-4">
                <h2 class="font-semibold text-gray-700">Form Edit Universitas</h2>
            </div>
            <div class="p-6">
                <form action="{{ route('universities.update', $universities[0]->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div id="tabs">
                        <nav class="flex border-b border-gray-300 mb-6 overflow-x-auto overflow-y-hidden" id="tabs-nav">
                            <a class="tab-nav-link px-2 py-2 -mb-px border-gray-300 border rounded-t-md inline-flex items-center gap-x-2 text-sm font-semibold whitespace-nowrap text-indigo-600 focus:outline-none focus:text-indigo-700"
                                href="#" data-tab="data-universitas" aria-current="page">Data Universitas</a>
                            @foreach ($universities as $index => $uni)
                                <a class="tab-nav-link px-2 py-2 -mb-px border-gray-300 border rounded-t-md inline-flex items-center gap-x-2 text-sm whitespace-nowrap text-indigo-600 focus:outline-none focus:text-indigo-700"
                                    href="#" data-tab="passing-grade-{{ $index + 1 }}">
                                    {{ $uni->nama_jurusan }}
                                    <button type="button" class="ml-2 text-red-600 font-semibold"
                                        onclick="showDeleteModal('passing-grade-{{ $index + 1 }}', this, {{ $uni->id }})">✕</button>
                                </a>
                            @endforeach

                            <a class="px-2 py-2 hover:-mb-px hover:border-gray-300 hover:border hover:rounded-t-md inline-flex items-center gap-x-2 text-sm whitespace-nowrap text-indigo-600 focus:outline-none focus:text-indigo-700"
                                href="#" id="add-tab">Tambah Passing Grade</a>
                        </nav>
                        <div id="tabs-content">
                            <div id="data-universitas" class="tab-content">
                                <!-- Nama Universitas Input -->
                                <div class="mb-6">
                                    <label for="nama_universitas" class="mb-2 block text-gray-800">Nama Universitas</label>
                                    <input type="text" id="nama_universitas" name="nama_universitas"
                                        class="border border-gray-300 text-gray-900 rounded focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2 px-3"
                                        placeholder="Nama Universitas"
                                        value="{{ old('nama_universitas', $universities[0]->nama_universitas) }}"
                                        required />
                                </div>
                            </div>
                            @foreach ($universities as $index => $uni)
                                <div id="passing-grade-{{ $index + 1 }}" class="tab-content">
                                    <!-- Gambar RNM Input -->
                                    <div class="mb-6">
                                        <label for="gambar_rnm_{{ $index + 1 }}" class="mb-2 block text-gray-800">Gambar
                                            RNM</label>
                                        <input type="file" id="gambar_rnm_{{ $index + 1 }}" name="gambar_rnm[]"
                                            class="border border-gray-300 text-gray-900 rounded focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2 px-3" />
                                        <img id="preview_gambar_rnm_{{ $index + 1 }}"
                                            src="{{ $uni->gambar_rnm ? asset('storage/' . $uni->gambar_rnm) : '' }}"
                                            class="mt-3 w-32 h-32 object-cover" />
                                    </div>
                                    <!-- Nama Jurusan Input -->
                                    <div class="mb-6">
                                        <label for="nama_jurusan_{{ $index + 1 }}" class="mb-2 block text-gray-800">Nama
                                            Jurusan</label>
                                        <input type="text" id="nama_jurusan_{{ $index + 1 }}" name="nama_jurusan[]"
                                            class="border border-gray-300 text-gray-900 rounded focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2 px-3"
                                            placeholder="Nama Jurusan"
                                            value="{{ old('nama_jurusan.' . $index, $uni->nama_jurusan) }}" required
                                            oninput="updateTabName(this, 'passing-grade-{{ $index + 1 }}')" />
                                    </div>
                                    <!-- Nilai RNM Input -->
                                    <div class="mb-6">
                                        <label for="nilai_rnm_{{ $index + 1 }}" class="mb-2 block text-gray-800">Nilai
                                            RNM</label>
                                        <input type="number" id="nilai_rnm_{{ $index + 1 }}" name="nilai_rnm[]"
                                            class="border border-gray-300 text-gray-900 rounded focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2 px-3"
                                            placeholder="Nilai RNM"
                                            value="{{ old('nilai_rnm.' . $index, $uni->nilai_rnm) }}" required />
                                    </div>
                                    <!-- URL Info Pendaftaran Input -->
                                    <div class="mb-6">
                                        <label for="url_info_pendaftaran_{{ $index + 1 }}"
                                            class="mb-2 block text-gray-800">URL Info Pendaftaran</label>
                                        <input type="url" id="url_info_pendaftaran_{{ $index + 1 }}"
                                            name="url_info_pendaftaran[]"
                                            class="border border-gray-300 text-gray-900 rounded focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2 px-3"
                                            placeholder="URL Info Pendaftaran"
                                            value="{{ old('url_info_pendaftaran.' . $index, $uni->url_info_pendaftaran) }}" />
                                    </div>
                                    <!-- URL Info Passing Grade Input -->
                                    <div class="mb-6">
                                        <label for="url_info_passinggrade_{{ $index + 1 }}"
                                            class="mb-2 block text-gray-800">URL Info Passing Grade</label>
                                        <input type="url" id="url_info_passinggrade_{{ $index + 1 }}"
                                            name="url_info_passinggrade[]"
                                            class="border border-gray-300 text-gray-900 rounded focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2 px-3"
                                            placeholder="URL Info Passing Grade"
                                            value="{{ old('url_info_passinggrade.' . $index, $uni->url_info_passinggrade) }}" />
                                    </div>
                                    <!-- URL Biaya Pendidikan Input -->
                                    <div class="mb-6">
                                        <label for="url_biaya_pendidikan_{{ $index + 1 }}"
                                            class="mb-2 block text-gray-800">URL Biaya Pendidikan</label>
                                        <input type="url" id="url_biaya_pendidikan_{{ $index + 1 }}"
                                            name="url_biaya_pendidikan[]"
                                            class="border border-gray-300 text-gray-900 rounded focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2 px-3"
                                            placeholder="URL Biaya Pendidikan"
                                            value="{{ old('url_biaya_pendidikan.' . $index, $uni->url_biaya_pendidikan) }}" />
                                    </div>
                                    <input type="hidden" name="university_ids[]" value="{{ $uni->id }}">
                                </div>
                            @endforeach
                            <!-- Dynamic Passing Grade Tabs -->
                        </div>
                    </div>
                    <input type="hidden" name="deleted_universities" id="deleted_universities">

                    <!-- Submit Button -->
                    <button type="submit"
                        class="btn gap-x-2 bg-indigo-600 text-white border-indigo-600 disabled:opacity-50 disabled:pointer-events-none hover:bg-indigo-800 hover:border-indigo-800 active:bg-indigo-800 active:border-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-300 mt-6">
                        Simpan Universitas
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div id="deleteModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div
                            class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                            <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Hapus Passing Grade
                            </h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-500">
                                    Apakah Anda yakin ingin menghapus data passing grade ini? Tindakan ini tidak dapat
                                    diurungkan.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button id="confirmDeleteButton" type="button"
                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Hapus
                    </button>
                    <button id="cancelDeleteButton" type="button"
                        class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showDeleteModal(tabId, tabNav, universityId) {
            const deleteModal = document.getElementById('deleteModal');
            deleteModal.classList.remove('hidden');

            const confirmDeleteButton = document.getElementById('confirmDeleteButton');
            confirmDeleteButton.onclick = function() {
                removeTabFromDatabase(tabId, tabNav, universityId);
                deleteModal.classList.add('hidden');
            };

            const cancelDeleteButton = document.getElementById('cancelDeleteButton');
            cancelDeleteButton.onclick = function() {
                deleteModal.classList.add('hidden');
            };
        }

        function removeTabFromDatabase(tabId, tabNav, universityId) {
            // Remove the tab content
            const tabContent = document.getElementById(tabId);
            if (tabContent) {
                tabContent.remove();
            }

            // Remove the tab nav
            if (tabNav && tabNav.parentElement) {
                tabNav.parentElement.remove();
            }

            // Add the removed university ID to the hidden input
            if (universityId !== null) {
                const deletedUniversitiesInput = document.getElementById('deleted_universities');
                const deletedIds = deletedUniversitiesInput.value ? JSON.parse(deletedUniversitiesInput.value) : [];
                deletedIds.push(universityId);
                deletedUniversitiesInput.value = JSON.stringify(deletedIds);
            }

            // Activate the first tab
            activateTab('data-universitas');
        }

        function removeNewTab(tabId, tabNav) {
            // Remove the tab content
            const tabContent = document.getElementById(tabId);
            if (tabContent) {
                tabContent.remove();
            }

            // Remove the tab nav
            if (tabNav && tabNav.parentElement) {
                tabNav.parentElement.remove();
            }

            // Activate the first tab
            activateTab('data-universitas');
        }

        function activateTab(tabId) {
            const tabContents = document.querySelectorAll('.tab-content');
            tabContents.forEach(tabContent => tabContent.style.display = 'none');

            const tabNavs = document.querySelectorAll('#tabs-nav a');
            tabNavs.forEach(tabNav => tabNav.classList.remove('border-indigo-600', 'text-indigo-600', 'font-semibold'));

            const activeTabContent = document.getElementById(tabId);
            if (activeTabContent) {
                activeTabContent.style.display = 'block';
            }

            const activeTabNav = document.querySelector(`#tabs-nav a[data-tab="${tabId}"]`);
            if (activeTabNav) {
                activeTabNav.classList.add('border-indigo-600', 'text-indigo-600', 'font-semibold');
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const tabsNav = document.getElementById('tabs-nav');
            const tabsContent = document.getElementById('tabs-content');
            let tabCount = {{ count($universities) }};
            const deletedUniversitiesInput = document.getElementById('deleted_universities');

            document.getElementById('add-tab').addEventListener('click', function(e) {
                e.preventDefault();
                tabCount++;
                const tabId = 'passing-grade-' + tabCount;

                const newTabNav = document.createElement('a');
                newTabNav.className =
                    'tab-nav-link px-2 py-2 -mb-px border-gray-300 border rounded-t-md inline-flex items-center gap-x-2 text-sm whitespace-nowrap text-indigo-600 focus:outline-none focus:text-indigo-700';
                newTabNav.href = '#';
                newTabNav.dataset.tab = tabId;
                newTabNav.innerHTML =
                    `Passing Grade #${tabCount} <button type="button" class="ml-2 text-red-600 font-semibold" onclick="removeNewTab('${tabId}', this)">✕</button>`;

                tabsNav.insertBefore(newTabNav, this);

                const newTabContent = document.createElement('div');
                newTabContent.id = tabId;
                newTabContent.className = 'tab-content';
                newTabContent.innerHTML = `
            <div class="mb-6">
                <label for="gambar_rnm_${tabCount}" class="mb-2 block text-gray-800">Gambar RNM</label>
                <input type="file" id="gambar_rnm_${tabCount}" name="gambar_rnm[]"
                       class="border border-gray-300 text-gray-900 rounded focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2 px-3" />
                <img id="preview_gambar_rnm_${tabCount}" class="mt-3 w-32 h-32 object-cover" />
            </div>
            <div class="mb-6">
                <label for="nama_jurusan_${tabCount}" class="mb-2 block text-gray-800">Nama Jurusan</label>
                <input type="text" id="nama_jurusan_${tabCount}" name="nama_jurusan[]"
                       class="border border-gray-300 text-gray-900 rounded focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2 px-3"
                       placeholder="Nama Jurusan" required 
                       oninput="updateTabName(this, '${tabId}')" />
            </div>
            <div class="mb-6">
                <label for="nilai_rnm_${tabCount}" class="mb-2 block text-gray-800">Nilai RNM</label>
                <input type="number" id="nilai_rnm_${tabCount}" name="nilai_rnm[]"
                       class="border border-gray-300 text-gray-900 rounded focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2 px-3"
                       placeholder="Nilai RNM" required />
            </div>
            <div class="mb-6">
                <label for="url_info_pendaftaran_${tabCount}" class="mb-2 block text-gray-800">URL Info Pendaftaran</label>
                <input type="url" id="url_info_pendaftaran_${tabCount}" name="url_info_pendaftaran[]"
                       class="border border-gray-300 text-gray-900 rounded focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2 px-3"
                       placeholder="URL Info Pendaftaran" />
            </div>
            <div class="mb-6">
                <label for="url_info_passinggrade_${tabCount}" class="mb-2 block text-gray-800">URL Info Passing Grade</label>
                <input type="url" id="url_info_passinggrade_${tabCount}" name="url_info_passinggrade[]"
                       class="border border-gray-300 text-gray-900 rounded focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2 px-3"
                       placeholder="URL Info Passing Grade" />
            </div>
            <div class="mb-6">
                <label for="url_biaya_pendidikan_${tabCount}" class="mb-2 block text-gray-800">URL Biaya Pendidikan</label>
                <input type="url" id="url_biaya_pendidikan_${tabCount}" name="url_biaya_pendidikan[]"
                       class="border border-gray-300 text-gray-900 rounded focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2 px-3"
                       placeholder="URL Biaya Pendidikan" />
            </div>`;

                tabsContent.appendChild(newTabContent);
                activateTab(tabId);

                newTabNav.addEventListener('click', function(e) {
                    e.preventDefault();
                    activateTab(tabId);
                });
            });

            document.querySelectorAll('.tab-nav-link').forEach(function(link) {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    activateTab(this.dataset.tab);
                });
            });

            window.removeNewTab = function(tabId, button) {
                const tabNav = button.parentElement;
                tabNav.parentElement.removeChild(tabNav);

                const tabContent = document.getElementById(tabId);
                tabContent.parentElement.removeChild(tabContent);

                activateTab('data-universitas');
            }

            window.updateTabName = function(input, tabId) {
                const tabNav = document.querySelector(`#tabs-nav a[data-tab="${tabId}"]`);
                tabNav.firstChild.textContent = input.value || `Passing Grade #${tabId.split('-')[2]}`;
            }

            $('input[type="file"]').change(function(e) {
                const inputId = $(this).attr('id');
                const index = inputId.split('_')[2];
                const previewId = `#preview_gambar_rnm_${index}`;

                const file = e.target.files[0];
                const reader = new FileReader();

                reader.onload = function(e) {
                    $(previewId).attr('src', e.target.result);
                };

                reader.readAsDataURL(file);
            });

            function activateTab(tabId) {
                const tabContents = document.querySelectorAll('.tab-content');
                tabContents.forEach(tabContent => tabContent.style.display = 'none');

                const tabNavs = document.querySelectorAll('#tabs-nav a');
                tabNavs.forEach(tabNav => tabNav.classList.remove('border-indigo-600', 'text-indigo-600',
                    'font-semibold'));

                const activeTabContent = document.getElementById(tabId);
                if (activeTabContent) {
                    activeTabContent.style.display = 'block';
                }

                const activeTabNav = document.querySelector(`#tabs-nav a[data-tab="${tabId}"]`);
                if (activeTabNav) {
                    activeTabNav.classList.add('border-indigo-600', 'text-indigo-600', 'font-semibold');
                }
            }

            // Ensure only the first tab content is visible on page load
            activateTab('data-universitas');
        });
    </script>
@endsection
