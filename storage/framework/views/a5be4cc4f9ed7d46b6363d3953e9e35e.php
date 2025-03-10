<?php $__env->startSection('title', 'Customers'); ?>

<?php $__env->startPush('css'); ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Customers</h4>
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                <li class="breadcrumb-item active">Customers</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">All Customer</h4>


                                    <!-- create new cusmer offline mood -->
                                    <?php if (\Illuminate\Support\Facades\Blade::check('hasPermission', 'Create Customer')): ?>
                                        <a href="<?php echo e(route('admin.customers.offline')); ?>" class="btn btn-success">
                                            Create New Customer (Offline mood)
                                        </a>
                                    <?php endif; ?>



                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example" class="table table-borderless align-middle mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th scope="col">SL</th>
                                                    <th scope="col">Name</th>
                                                    
                                                    
                                                    
                                                    <th scope="col">Phone Number</th>
                                                    
                                                    <th scope="col">Web file / Application Id</th>
                                                    <th scope="col">Already Uploaded</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__empty_1 = true; $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <tr>
                                                        <td class="fw-medium text-center"><?php echo e($key + 1); ?></td>
                                                        <?php
                                                            $childData = App\Models\Customer::countChaild(
                                                                $customer->id,
                                                            );
                                                        ?>

                                                        <td><?php echo e($customer->name . ' (' . $childData['count'] . ')'); ?>

                                                            <?php if($childData['count'] > 0): ?>
                                                                <span style="font-size: 12px; color: gray;">
                                                                    (<?php echo e($childData['ids']->implode(', ')); ?>)
                                                                    <!-- Display the list of child IDs -->
                                                                </span>
                                                            <?php endif; ?>
                                                        </td>


                                                        <td><a href="tel:<?php echo e($customer->phone); ?>"><?php echo e($customer->phone); ?></a>
                                                        </td>

                                                        <td>
                                                            <form enctype="multipart/form-data"
                                                                action="<?php echo e(route('admin.customers.webfileupload', $customer->id)); ?>"
                                                                method="POST">
                                                                <?php echo csrf_field(); ?>
                                                                <input type="file" name="uploaded_file"
                                                                    id="uploaded_file">
                                                                <input type="submit" value="Upload">
                                                            </form>
                                                        </td>

                                                        <td>
                                                            <?php
                                                                $webFileId = App\Models\Customer::webFileAppId(
                                                                    $customer->id,
                                                                );
                                                                // dd($webFileId->web_file_app_id)
                                                            ?>

                                                            <?php if($webFileId->web_file_app_id): ?>
                                                                <span>Already added:
                                                                    <span class="text-success cursor-pointer"
                                                                        onclick="printPDF('<?php echo e($webFileId->web_file_app_id); ?>')">Print</span>
                                                                    /
                                                                    <a class="text-success"
                                                                        href="<?php echo e(asset('uploads/visa-forms/documents/' . $webFileId->web_file_app_id)); ?>"
                                                                        download="<?php echo e($webFileId->web_file_app_id); ?>">
                                                                        Download
                                                                    </a>
                                                                </span>
                                                            <?php else: ?>
                                                                <span>No file added.</span>
                                                            <?php endif; ?>
                                                        </td>




                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <tr>
                                                        <td>No record Found.</td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('js'); ?>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>

    <script src="<?php echo e(asset('backend/assets/js/pages/datatables.init.js')); ?>"></script>

    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable();
            table.page.len(100).draw(); // Set the default pagination limit to 100
        });
    </script>



    <script>
        // Function to open the PDF in a new window and trigger print dialog
        function printPDF(docs) {
            var pdfWindow = window.open("<?php echo e(asset('uploads/visa-forms/documents/')); ?>" + "/" + docs, "_blank");
            pdfWindow.onload = function() {
                pdfWindow.print();
                pdfWindow.onafterprint = function() {
                    pdfWindow.close(); // Close the window after printing
                };
            };
        }
    </script>


    
    <script>
        $(document).ready(function() {
            <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                $('#saveChangesBtn<?php echo e($customer->id); ?>').click(function() {
                    var customerId = $(this).data('customer-id');
                    var formData = $('#updateStatusForm' + customerId).serialize(); // Serialize form data

                    $.ajax({
                        url: "<?php echo e(route('admin.update.visa.status', $customer->id)); ?>",
                        type: 'POST',
                        data: formData,
                        success: function(response) {
                            // Update the visa status badge in real-time
                            $('#visaStatusBadge' + customerId).html(response
                                .statusBadge); // Update the badge

                            // Change the "Update Status" button text to indicate success
                            $('#saveChangesBtn' + customerId).text(
                                'Status Updated'); // Change button text

                            // Optionally, disable the button to prevent further clicks
                            $('#saveChangesBtn' + customerId).prop('disabled', true);

                            // Close the modal
                            $('#exampleModal' + customerId).modal('hide');
                        },
                        error: function(xhr) {
                            alert('An error occurred. Please try again.');
                        }
                    });
                });
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.backend.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/bokhtiartoshar/Desktop/Project/Sajon Bhai/visaExpert.com-master/resources/views/backend/customer/webfileuploadList.blade.php ENDPATH**/ ?>