<div>
    <script src="{{asset('dashboard/js/app.min.js')}}"></script>
    <script src="{{asset('dashboard/js/chart.min.js')}}"></script>
    <script src="{{asset('dashboard/js/admin.js')}}"></script>
    <script src="{{asset('dashboard/js/bundles/apexcharts/apexcharts.min.js')}}"></script>
    <script src="{{asset('dashboard/js/pages/index.js')}}"></script>
    @stack('scripts')
    <script src="{{asset('dashboard/js/sweetalert2@11')}}"></script>
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('alert', (event) => {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer;
                        toast.onmouseleave = Swal.resumeTimer;
                    }
                });
                Toast.fire({
                    icon: event.icon,
                    title: event.message
                });
            });

        })
    </script>
    @livewireScripts

</div>
