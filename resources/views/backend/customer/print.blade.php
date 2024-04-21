<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print PDF</title>
</head>
<body>
    <script>
        // Function to open the PDF in a new window and trigger print dialog
        function printPDF() {
            var pdfWindow = window.open("{{ asset('uploads/visa-forms/documents/' . $docs) }}", "_blank");
            pdfWindow.onload = function() {
                pdfWindow.print();
                pdfWindow.onafterprint = function() {
                    pdfWindow.close(); // Close the window after printing
                };
            };
        }

        // Call the function to print the PDF when the page loads
        window.onload = function() {
            printPDF();
        };
    </script>
</body>
</html>
