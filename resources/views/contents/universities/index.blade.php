@extends('layouts.layout')

@section('content')
    <div class="bg-indigo-600 px-8 pt-10 lg:pt-14 pb-16 flex justify-between items-center mb-3">
        <h1 class="text-xl text-white">Rekomendasi Universitas</h1>
        <a href="{{ route('universities.create') }}"
            class="btn bg-white text-gray-800 border-gray-600 hover:bg-gray-100 hover:text-gray-800 hover:border-gray-200 active:bg-gray-100 active:text-gray-800 active:border-gray-200 focus:outline-none focus:ring-4 focus:ring-indigo-300">
            Tambah Rekomendasi Baru
        </a>
    </div>
    <div class="mx-6 mb-6">
        <div class="card h-full shadow">
            <div class="relative overflow-x-auto" data-simplebar style="max-height: 600px">
                <table class="text-left w-full whitespace-nowrap">
                    <thead class="text-gray-700 bg-gray-100">
                        <tr>
                            <th scope="col" class="px-6 py-3">No</th>
                            <th scope="col" class="px-6 py-3">Nama Universitas</th>
                            <th scope="col" class="px-6 py-3">Nama Jurusan</th>
                            <th scope="col" class="px-6 py-3">Nilai RNM</th>
                            <th scope="col" class="px-6 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($universities->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center py-3 border-b border-gray-300">Tidak ada data
                                    universitas.</td>
                            </tr>
                        @else
                            @foreach ($universities->groupBy('nama_universitas') as $index => $group)
                                @php
                                    $university = $group->first();
                                @endphp
                                <tr>
                                    <td class="border-b border-gray-300 py-3 px-6">{{ $loop->iteration }}</td>
                                    <td class="border-b border-gray-300 py-3 px-6">{{ $university->nama_universitas }}</td>
                                    <td class="border-b border-gray-300 py-3 px-6">
                                        {{ $group->pluck('nama_jurusan')->join(', ') }}</td>
                                    <td class="border-b border-gray-300 py-3 px-6">
                                        {{ $group->pluck('nilai_rnm')->join(', ') }}</td>
                                    <td class="border-b border-gray-300 py-3 px-6">
                                        <a href="{{ route('universities.edit', $university->id) }}"
                                            class="inline-flex items-center gap-x-2 bg-indigo-600 text-white border-indigo-600 rounded hover:bg-indigo-800 hover:border-indigo-800 active:bg-indigo-800 active:border-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-300 aspect-square transition-all ease-in-out px-3 py-1">
                                            <i data-feather="edit-2" class="w-4 h-4"></i>
                                        </a>
                                        <button type="button"
                                            class="delete-button inline-flex items-center gap-x-2 bg-red-600 text-white border-red-600 rounded hover:bg-red-800 hover:border-red-800 active:bg-red-800 active:border-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 aspect-square transition-all ease-in-out px-3 py-1"
                                            data-url="{{ route('universities.destroy', $university->id) }}"
                                            data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-title="Hapus Rekomendasi Universitas">
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
    @include('contents.universities.components.delete-modal')
@endsection
