 <!-- All Jquery -->
<!-- ============================================================== -->
<script src="{{asset ('libs/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset ('libs/popper.js/dist/umd/popper.min.js')}}"></script>
<script src="{{asset ('libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- apps -->
<script src="{{asset ('dist/js/app-style-switcher.js')}}"></script>
<script src="{{asset ('dist/js/feather.min.js')}}"></script>
<script src="{{asset ('libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>
<script src="{{asset ('dist/js/sidebarmenu.js')}}"></script>
<!--Custom JavaScript -->
<script src="{{asset ('dist/js/custom.min.js')}}"></script>
<!-- DataTables for this page -->
<script type="text/javascript" src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/datatables-demo.js')}}"></script>

<script>
    function jam() {
        var time = new Date(),
            hours = time.getHours(),
            minutes = time.getMinutes(),
            seconds = time.getSeconds();
        document.querySelectorAll('.jam')[0].innerHTML = harold(hours) + ":" + harold(minutes) + ":" + harold(seconds);

        function harold(standIn) {
            if (standIn < 10) {
                standIn = '0' + standIn
            }
            return standIn;
        }
    }
    setInterval(jam, 1000);
</script>