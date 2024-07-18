<!-- Toast Notification -->
<div id="toast"
    class="fixed bottom-5 right-5 flex items-center p-4 mb-4 w-full max-w-xs text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800 translate-y-10 opacity-0 transition-transform duration-300 ease-out hidden">
    <div id="toast-icon" class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-white rounded-lg">
        <i data-feather="alert-circle" class="w-5 h-5"></i>
    </div>
    <div class="ml-3 text-sm font-normal" id="toast-body"></div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toast = document.getElementById('toast');
        const toastBody = document.getElementById('toast-body');
        const toastIcon = document.getElementById('toast-icon');

        const successMessage = "{{ session('success') }}";
        const errorMessage = @json($errors->all());

        if (successMessage) {
            toastBody.textContent = successMessage;
            toastIcon.classList.add('bg-blue-500', 'dark:bg-blue-600');
            showToast();
        }

        if (errorMessage.length > 0) {
            toastBody.textContent = errorMessage[0];
            toastIcon.classList.add('bg-red-500', 'dark:bg-red-600');
            showToast();
        }

        function showToast() {
            toast.classList.remove('hidden', 'translate-y-10', 'opacity-0');
            toast.classList.add('translate-y-0', 'opacity-100');

            setTimeout(() => {
                closeToast();
            }, 4000);
        }
    });

    function closeToast() {
        const toast = document.getElementById('toast');
        toast.classList.add('translate-y-10', 'opacity-0');
        setTimeout(() => {
            toast.classList.add('hidden');
        }, 300);
    }
</script>
