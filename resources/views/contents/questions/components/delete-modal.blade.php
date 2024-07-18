<!-- Modal Konfirmasi Hapus -->
<div id="deleteModal"
    class="fixed inset-0 bg-gray-600 bg-opacity-50 opacity-0 hidden flex items-center justify-center p-4 transition-opacity duration-300 z-10">
    <div
        class="opacity-0 transition-all transform -translate-y-1/2 duration-300 bg-white rounded-lg shadow-xl p-6 w-full max-w-md m-auto top-1/2">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Konfirmasi Hapus</h3>
        <p class="text-gray-600">Apakah Anda yakin ingin menghapus item ini?</p>
        <div class="text-right space-x-2 mt-4">
            <button id="cancelButton" class="bg-gray-300 hover:bg-gray-400 text-gray-800 rounded px-4 py-2">Batal</button>
            <button id="confirmButton" class="bg-red-600 hover:bg-red-700 text-white rounded px-4 py-2">Hapus</button>
        </div>
    </div>
</div>
