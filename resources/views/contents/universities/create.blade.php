@extends('layouts.layout')

@section('content')
    <div class="bg-indigo-600 px-8 pt-10 lg:pt-14 pb-16 flex justify-between items-center mb-3">
        <h1 class="text-xl text-white">Tambah Universitas Baru</h1>
    </div>
    <div class="-mt-12 mx-6 mb-6">
        <div class="card h-full shadow">
            <div class="border-b border-gray-300 px-5 py-4">
                <h2 class="font-semibold text-gray-700">Form Tambah Universitas</h2>
            </div>
            <div class="p-6">
                <form action="{{ route('universities.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div id="tabs">
                        <nav class="flex border-b border-gray-300 mb-6 overflow-x-auto overflow-y-hidden" id="tabs-nav">
                            <a class="tab-nav-link px-2 py-2 -mb-px border-gray-300 border rounded-t-md inline-flex items-center gap-x-2 text-sm font-semibold whitespace-nowrap text-indigo-600 focus:outline-none focus:text-indigo-700"
                                href="#" data-tab="data-universitas" aria-current="page">Data Universitas</a>
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
                                        placeholder="Nama Universitas" required />
                                </div>
                            </div>
                            <!-- Dynamic Passing Grade Tabs -->
                        </div>
                    </div>
                    <!-- Submit Button -->
                    <button type="submit"
                        class="btn gap-x-2 bg-indigo-600 text-white border-indigo-600 disabled:opacity-50 disabled:pointer-events-none hover:bg-indigo-800 hover:border-indigo-800 active:bg-indigo-800 active:border-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-300 mt-6">
                        Simpan Universitas
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabsNav = document.getElementById('tabs-nav');
            const tabsContent = document.getElementById('tabs-content');
            let tabCount = 0;

            document.getElementById('add-tab').addEventListener('click', function(e) {
                e.preventDefault();
                tabCount++;
                const tabId = 'passing-grade-' + tabCount;

                // Create new tab nav
                const newTabNav = document.createElement('a');
                newTabNav.className =
                    'tab-nav-link px-2 py-2 -mb-px border-gray-300 border rounded-t-md inline-flex items-center gap-x-2 text-sm whitespace-nowrap text-indigo-600 focus:outline-none focus:text-indigo-700';
                newTabNav.href = '#';
                newTabNav.dataset.tab = tabId;
                newTabNav.innerHTML =
                    `Passing Grade #${tabCount} <button type="button" class="ml-2 text-indigo-600 font-semibold" onclick="removeTab('${tabId}', this)">✕</button>`;

                tabsNav.insertBefore(newTabNav, this);

                // Create new tab content
                const newTabContent = document.createElement('div');
                newTabContent.id = tabId;
                newTabContent.className = 'tab-content';
                newTabContent.innerHTML = `
            <!-- Gambar RNM Input -->
            <div class="mb-6">
                <label for="gambar_rnm_${tabCount}" class="mb-2 block text-gray-800">Gambar RNM</label>
                <input type="file" id="gambar_rnm_${tabCount}" name="gambar_rnm[]"
                       class="border border-gray-300 text-gray-900 rounded focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2 px-3" />
            </div>
            <!-- Nama Jurusan Input -->
            <div class="mb-6">
                <label for="nama_jurusan_${tabCount}" class="mb-2 block text-gray-800">Nama Jurusan</label>
                <input type="text" id="nama_jurusan_${tabCount}" name="nama_jurusan[]"
                       class="border border-gray-300 text-gray-900 rounded focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2 px-3"
                       placeholder="Nama Jurusan" required oninput="updateTabName(this, '${tabId}')" />
            </div>
            <!-- Nilai RNM Input -->
            <div class="mb-6">
                <label for="nilai_rnm_${tabCount}" class="mb-2 block text-gray-800">Nilai RNM</label>
                <input type="number" id="nilai_rnm_${tabCount}" name="nilai_rnm[]"
                       class="border border-gray-300 text-gray-900 rounded focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2 px-3"
                       placeholder="Nilai RNM" required />
            </div>
            <!-- URL Info Pendaftaran Input -->
            <div class="mb-6">
                <label for="url_info_pendaftaran_${tabCount}" class="mb-2 block text-gray-800">URL Info Pendaftaran</label>
                <input type="url" id="url_info_pendaftaran_${tabCount}" name="url_info_pendaftaran[]"
                       class="border border-gray-300 text-gray-900 rounded focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2 px-3"
                       placeholder="URL Info Pendaftaran" />
            </div>
            <!-- URL Info Passing Grade Input -->
            <div class="mb-6">
                <label for="url_info_passinggrade_${tabCount}" class="mb-2 block text-gray-800">URL Info Passing Grade</label>
                <input type="url" id="url_info_passinggrade_${tabCount}" name="url_info_passinggrade[]"
                       class="border border-gray-300 text-gray-900 rounded focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2 px-3"
                       placeholder="URL Info Passing Grade" />
            </div>
            <!-- URL Biaya Pendidikan Input -->
            <div class="mb-6">
                <label for="url_biaya_pendidikan_${tabCount}" class="mb-2 block text-gray-800">URL Biaya Pendidikan</label>
                <input type="url" id="url_biaya_pendidikan_${tabCount}" name="url_biaya_pendidikan[]"
                       class="border border-gray-300 text-gray-900 rounded focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2 px-3"
                       placeholder="URL Biaya Pendidikan" />
            </div>`;

                tabsContent.appendChild(newTabContent);
                activateTab(tabId);

                // Event listener for new tab nav
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

            window.removeTab = function(tabId, button) {
                // Remove the tab nav
                const tabNav = button.parentElement;
                tabNav.parentElement.removeChild(tabNav);

                // Remove the tab content
                const tabContent = document.getElementById(tabId);
                tabContent.parentElement.removeChild(tabContent);

                // Activate the first tab
                activateTab('data-universitas');
            }

            function activateTab(tabId) {
                // Hide all tab contents
                const tabContents = document.querySelectorAll('.tab-content');
                tabContents.forEach(tabContent => tabContent.style.display = 'none');

                // Remove active class from all tab navs
                const tabNavs = document.querySelectorAll('#tabs-nav a');
                tabNavs.forEach(tabNav => tabNav.classList.remove('border-indigo-600', 'text-indigo-600',
                    'font-semibold'));

                // Show the active tab content
                document.getElementById(tabId).style.display = 'block';

                // Add active class to the clicked tab nav
                document.querySelector(`#tabs-nav a[data-tab="${tabId}"]`).classList.add('border-indigo-600',
                    'text-indigo-600', 'font-semibold');
            }

            window.updateTabName = function(input, tabId) {
                const tabNav = document.querySelector(`#tabs-nav a[data-tab="${tabId}"]`);
                tabNav.firstChild.textContent = input.value || `Passing Grade #${tabId.split('-')[2]}`;
            }

            // Activate the first tab
            activateTab('data-universitas');
        });
    </script>
@endsection
