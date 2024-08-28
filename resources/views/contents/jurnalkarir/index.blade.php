@extends('layouts.layout')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Jurnal Karir - Admin View</h1>

        <table class="table-auto w-full bg-white rounded shadow">
            <thead>
                <tr class="bg-gray-200 text-gray-700">
                    <th class="px-4 py-2">No</th>
                    <th class="px-4 py-2">Nama Pengguna</th>
                    <th class="px-4 py-2">Detail</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $index => $user)
                    <tr class="text-gray-700">
                        <td class="border px-4 py-2 text-center">{{ $index + 1 }}</td>
                        <td class="border px-4 py-2">{{ $user->user->name }}</td>
                        <td class="border px-4 py-2 text-center">
                            <button class="bg-blue-500 text-white px-4 py-2 rounded"
                                onclick="showDetails({{ $user->user_id }})">Lihat Detail</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div id="detailModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-2xl relative">
            <button onclick="closeModal()" class="absolute top-7 right-7 text-white hover:text-gray-400">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <div id="modalContent">
                <!-- Dynamic content will be loaded here -->
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function showDetails(userId) {
            $.ajax({
                url: `/jurnalkarir/${userId}`,
                method: 'GET',
                success: function(data) {
                    let content = `
                    <div class="p-4 bg-indigo-600 text-white rounded-lg mb-4">
                        <h2 class="text-2xl font-bold text-white">Detail Jurnal Karir</h2>
                        <p class="text-sm">Lihat keahlian, tujuan, dan tugas harian pengguna secara rinci.</p>
                    </div>
                `;

                    if (data.skills.length > 0) {
                        content += `
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-indigo-600 mb-2">Keahlian</h3>
                            <ul role="list" class="marker:text-indigo-600 list-disc pl-5 space-y-2 text-base bg-gray-100 p-4 rounded-lg shadow">
                    `;
                        data.skills.forEach(skill => {
                            content += `<li class="ml-4">${skill.content}</li>`;
                        });
                        content += `</ul></div>`;
                    } else {
                        content += `<p class="text-gray-600 mb-6">Belum ada data keahlian.</p>`;
                    }

                    if (data.goals.length > 0) {
                        content += `
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-indigo-600 mb-2">Tujuan</h3>
                            <ul role="list" class="marker:text-indigo-600 list-disc pl-5 space-y-2 text-base bg-gray-100 p-4 rounded-lg shadow">
                    `;
                        data.goals.forEach(goal => {
                            content += `<li class="ml-4">${goal.content}</li>`;
                        });
                        content += `</ul></div>`;
                    } else {
                        content += `<p class="text-gray-600 mb-6">Belum ada data tujuan.</p>`;
                    }

                    if (data.todos.length > 0) {
                        content += `
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-indigo-600 mb-2">Tugas Harian</h3>
                            <ul role="list" class="marker:text-indigo-600 list-disc pl-5 space-y-2 text-base bg-gray-100 p-4 rounded-lg shadow">
                    `;
                        data.todos.forEach(todo => {
                            content += `<li class="ml-4">${todo.content} (Target: ${todo.date})</li>`;
                        });
                        content += `</ul></div>`;
                    } else {
                        content += `<p class="text-gray-600 mb-6">Belum ada data tugas harian.</p>`;
                    }

                    $('#modalContent').html(content);
                    openModal();
                }
            });
        }

        function openModal() {
            $('#detailModal').removeClass('hidden');
        }

        function closeModal() {
            $('#detailModal').addClass('hidden');
        }
    </script>
@endsection
