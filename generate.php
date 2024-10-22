<?php
require 'vendor/autoload.php';

use PhpOffice\PhpWord\TemplateProcessor;
use Mpdf\Mpdf;

// Get form data
$name = $_POST['name'];
$date = $_POST['date'];
$monthrange = $_POST['monthrange'];

// Load the Word template
$template = new TemplateProcessor('template.docx');

// Replace placeholders with form data
$template->setValue('name', $name);
$template->setValue('date', $date);
$template->setValue('monthrange', $monthrange);

// Save the modified Word document
$template->saveAs('filled_template.docx');

// Convert the Word document to PDF
$mpdf = new Mpdf();
$wordContent = file_get_contents('filled_template.docx');
$mpdf->WriteHTML($wordContent);
$pdfOutput = 'generated_file.pdf';
$mpdf->Output($pdfOutput, 'D'); // D forces download of the PDF
?>
