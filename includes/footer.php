<script type="text/javascript" src="<?= BASE_URL ?>assets/js/new-prism.js"></script>
<!-- MDB SNIPPET -->
<script type="text/javascript" src="<?= BASE_URL ?>assets/js/dist/mdbsnippet.min.js"></script>
<!-- MDB -->
<script type="text/javascript" src="<?= BASE_URL ?>assets/js/mdb.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Add this in your HTML head or just before </body> -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Custom scripts -->
<script type="text/javascript">
    const sidenav = document.getElementById("sidenav-1");
    const instance = mdb.Sidenav.getInstance(sidenav);

    let innerWidth = null;

    const setMode = (e) => {
        // Check necessary for Android devices
        if (window.innerWidth === innerWidth) {
            return;
        }

        innerWidth = window.innerWidth;

        if (window.innerWidth < 1400) {
            instance.changeMode("over");
            instance.hide();
        } else {
            instance.changeMode("side");
            instance.show();
        }
    };

    setMode();

    // Event listeners
    window.addEventListener("resize", setMode);
</script>
<?php
if ($currentPage == "create-blog.php" || $currentPage == "blogs.php" || $currentPage == "edit-blog.php") {
?>

    <script src="<?= BASE_URL ?>assets/js/blog.js"></script>
    <script>
        tinymce.init({
            selector: '#description',
            plugins: 'advlist autolink lists link image charmap preview anchor pagebreak',
            toolbar: 'undo redo | formatselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code',
            height: 300,
            branding: false
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#blogTable').DataTable({
                responsive: true,
                pageLength: 10,
                columnDefs: [{
                        orderable: false,
                        targets: 0
                    } // disable sort on checkbox
                ]
            });

            // Select All Checkbox Function
            $('#selectAll').on('click', function() {
                $('input[type="checkbox"]').prop('checked', this.checked);
            });
        });
    </script>
<?php
}