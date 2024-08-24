<?php if(session('success')): ?>
    <script>
        $(document).ready(function () {
            Toastify({
                text: "<?php echo e(session('success')); ?>",
                duration: 3000,
                newWindow: true,
                close: true,
                gravity: "top",
                position: "right",
                stopOnFocus: true,
                style: {
                    background: "linear-gradient(to right, #00b09b, #96c93d)",
                },
                onClick: function () {
                }
            }).showToast();
        });
    </script>
<?php endif; ?>

<?php if(session('error')): ?>
    <script>
        $(document).ready(function () {
            Toastify({
                text: "<?php echo e(session('error')); ?>",
                duration: 3000,
                newWindow: true,
                close: true,
                gravity: "top",
                position: "right",
                stopOnFocus: true,
                style: {
                    background: "linear-gradient(to right, #ff5f6d, #ffc371)",
                },
                onClick: function () {
                }
            }).showToast();
        });
    </script>
<?php endif; ?>
<?php /**PATH /home/visatuey/visa.visaxpert.net/resources/views/layouts/alert.blade.php ENDPATH**/ ?>