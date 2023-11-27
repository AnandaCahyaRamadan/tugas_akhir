<script src="{{ asset ('template/vendor/js/helpers.js') }}"></script>
<script src="{{ asset ('template/js/config.js') }}"></script>
<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="{{ asset ('template/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset ('template/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset ('template/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset ('template/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

<script src="{{ asset ('template/vendor/js/menu.js') }}"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="{{ asset ('template/vendor/libs/apex-charts/apexcharts.js') }}"></script>

<!-- Main JS -->
<script src="{{ asset ('template/js/main.js') }}"></script>

<!-- Page JS -->
<script src="{{ asset ('template/js/dashboards-analytics.js') }}"></script>

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

<!-- Page level plugins -->
<script src="{{ asset ('template/vendor/libs/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset ('template/vendor/libs/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level plugins -->
<script src="{{ asset ('template/vendor/libs/croppie/croppie.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset ('template/js/datatables-demo.js') }}"></script>

<!-- Toastr CSS and JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- SweetAlert CSS and JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.0.1/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.0.1/dist/sweetalert2.all.min.js"></script>

<!-- Select 2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>

<!--  tanggal/Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<!-- Initialize Flatpickr -->
<script>
    flatpickr("#tanggal_pembayaran", {});
</script>

<script>
    $( '#single-select-field' ).select2( {
    theme: "bootstrap-5",
    width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
    placeholder: $( this ).data( 'placeholder' ),
} );
</script>

<script>
    $( '#multiple-select-field' ).select2( {
    theme: "bootstrap-5",
    width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
    placeholder: $( this ).data( 'placeholder' ),
    closeOnSelect: false,
} );
</script>

<!-- Toastr Initialization -->
<script>
    $(document).ready(function () {
        toastr.options = {
            "closeButton": true
        };

        @if(Session::has('success'))
            toastr.success('{{ Session::get('success') }}', 'Success');
        @endif

        @if(Session::has('error'))
            toastr.error('{{ Session::get('error') }}', 'Error');
        @endif

        @if(Session::has('status'))
            toastr.success('{{ Session::get('status') }}', 'Success');
        @endif

        @if(Session::has('resent'))
            toastr.success('Email verifikasi telah terkirim ulang.', 'Success');
        @endif
    });
</script>

<!-- SweetAlert Confirmation Dialog -->
<script>
    function notificationBeforeLogout(event, el) {
        event.preventDefault();
        Swal.fire({
            title: 'Yakin ingin keluar?',
            text: 'Anda harus login kembali setelah ini!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#696cff',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Keluar!',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                // Proceed with the delete action by submitting the logout form
                $("#logout").attr('action', $(el).attr('href'));
                $("#logout").submit();
            }
        });
    }
</script>
<script>
    function notificationBeforeDelete(event, el) {
        event.preventDefault();
        const deleteUrl = $(el).attr('href'); // Mengambil URL penghapusan dari atribut href pada elemen a
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: 'Anda akan menghapus data ini!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#696cff',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = deleteUrl; // Mengarahkan ke URL penghapusan
            }
        });
    }
</script>

