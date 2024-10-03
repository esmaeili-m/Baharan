<div>
    <script src="{{asset('dashboard/js/sweetalert2@11')}}"></script>
    <script src="{{asset('home/login/datepicker/jquery-3.7.1.min.js')}}"></script>
    <script src="{{asset('home/login/datepicker/persian-date.min.js')}}"></script>
    <script src="{{asset('home/login/datepicker/persian-datepicker.min.js')}}"></script>
    <script>

    </script>
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('alert', (event) => {
                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    width: 450,
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
</div>
