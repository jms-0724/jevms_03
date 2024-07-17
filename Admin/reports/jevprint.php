<?php
session_start();
require('fpdf186/fpdf.php');
require_once(__DIR__ . '/../../connections/connection.php');

class PDF extends FPDF
{
    // Page footer
    function Footer()
    {
        // Implement footer if needed
    }
}

// Instantiation of inherited class
$pdf = new PDF();
$journal_number = $_SESSION['jevNumber'];



// Fetching main journal entry data
$sql2 = $conn->prepare("SELECT * FROM tbl_journal_entry 
                        INNER JOIN tbl_user ON tbl_journal_entry.uid = tbl_user.uid 
                        INNER JOIN tbl_user_info ON tbl_user.user_info_id = tbl_user_info.user_info_id 
                        WHERE tbl_journal_entry.journal_voucher_id = :jevID");
                       
$sql2->bindParam(':jevID', $journal_number);
$sql2->execute();
$data2 = $sql2->fetch(PDO::FETCH_ASSOC);

// Adding page and setting font
$pdf->AliasNbPages();
$pdf->AddPage('P', 'Legal');
$pdf->SetFont('Arial', 'B', 12);

// Header
$pdf->Cell(150, 7, 'JOURNAL ENTRY VOUCHER', 'LTR', 0, 'C', false);
$pdf->cell(50, 7, '', 'LTR', 1, 'L', false);

$pdf->SetFont("Arial", '', 8);
$pdf->Cell(150, 5, 'BALAOAN WATER DISTRICT', 'LR', 0, 'C');
$pdf->Cell(25, 5, 'No:', 'L', 0, 'L');
$pdf->Cell(25, 5, $data2['journal_voucher_no'], 'R', 1, 'L');
$pdf->SetFont("Arial", '', 8);
$pdf->Cell(150, 5, 'Balaoan,La Union', 'LRB', 0, 'C');
$pdf->Cell(25, 5, 'Date:', 'LB', 0, 'L');
$pdf->Cell(25, 5, $data2['journal_date'], 'RB', 1, 'L');

$pdf->Cell(25, 5, '', 'LTR', 0, 'C');
$pdf->Cell(25, 5, '', 'LB', 0, 'L');
$pdf->Cell(150, 5, 'Accounting Entries', 'TBR', 1, 'L');

// Table headers
$pdf->Cell(25, 5, 'Responsibility', 'LR', 0, 'C');
$pdf->Cell(87, 5, '', 'L', 0, 'L');
$pdf->Cell(25, 5, 'Account', 'LR', 0, 'C');
$pdf->Cell(8, 5, 'P', 'LR', 0, 'C');
$pdf->Cell(55, 5, 'Amount', 'LBR', 1, 'C');
$pdf->Cell(25, 5, 'Center', 'LR', 0, 'C');
$pdf->Cell(25, 5, '', 'L', 0, 'L');
$pdf->Cell(62, 5, 'ACCOUNTS AND EXPLANATIONS', 'R', 0, 'L');
$pdf->Cell(25, 5, 'Code', 'LR', 0, 'C');
$pdf->Cell(8, 5, '', 'LR', 0, 'C');
$pdf->Cell(27.5, 5, 'Debit', 'LB', 0, 'C');
$pdf->Cell(27.5, 5, 'Credit', 'BR', 1, 'C');

// Fetch and display debit entries
$placement = "Debit";
$sql = $conn->prepare("SELECT * FROM `tbl_journal_entry` 
                        INNER JOIN tbl_journal_items ON tbl_journal_entry.journal_voucher_id = tbl_journal_items.journal_voucher_id 
                        INNER JOIN tbl_user ON tbl_journal_entry.uid = tbl_user.uid 
                        INNER JOIN tbl_user_info ON tbl_user.user_info_id = tbl_user_info.user_info_id 
                        INNER JOIN tbl_account_title ON tbl_journal_items.account_code = tbl_account_title.account_code 
                        WHERE tbl_journal_entry.journal_voucher_id = :jevId AND tbl_journal_items.journal_adjustment = :placement");
$sql->bindParam(':jevId', $journal_number);
$sql->bindParam(':placement', $placement);
$sql->execute();
$data = $sql->fetchAll(PDO::FETCH_ASSOC);

foreach ($data as $row) {
    $pdf->Cell(25, 5, '', 'LR', 0, 'C');
    $pdf->Cell(25, 5, $row['account_name'], 'L', 0, 'L');
    $pdf->Cell(62, 5, '', 'R', 0, 'L');
    $pdf->Cell(25, 5, $row['account_code'], 'LR', 0, 'C');
    $pdf->Cell(8, 5, '', 'LR', 0, 'C');
    $pdf->Cell(27.5, 5, $row['journal_amount'], 'LR', 0, 'C');
    $pdf->Cell(27.5, 5, '', 'R', 1, 'C');
}

// Fetch and display credit entries
$placement2 = "Credit";
$sql3 = $conn->prepare("SELECT * FROM `tbl_journal_entry` 
                        INNER JOIN tbl_journal_items ON tbl_journal_entry.journal_voucher_id = tbl_journal_items.journal_voucher_id 
                        INNER JOIN tbl_user ON tbl_journal_entry.uid = tbl_user.uid 
                        INNER JOIN tbl_user_info ON tbl_user.user_info_id = tbl_user_info.user_info_id 
                        INNER JOIN tbl_account_title ON tbl_journal_items.account_code = tbl_account_title.account_code 
                        WHERE tbl_journal_entry.journal_voucher_id = :jevId AND tbl_journal_items.journal_adjustment = :placement2");
$sql3->bindParam(':jevId', $journal_number);
$sql3->bindParam(':placement2', $placement2);
$sql3->execute();
$data3 = $sql3->fetchAll(PDO::FETCH_ASSOC);

foreach ($data3 as $row2) {
    $pdf->Cell(25, 5, '', 'LR', 0, 'C');
    $pdf->Cell(5, 5, '', 'L', 0, 'C');
    $pdf->Cell(20, 5, $row2['account_name'], '', 0, 'L');
    $pdf->Cell(62, 5, '', 'R', 0, 'L');
    $pdf->Cell(25, 5, $row2['account_code'], 'LR', 0, 'C');
    $pdf->Cell(8, 5, '', 'LR', 0, 'C');
    $pdf->Cell(27.5, 5, '', 'LR', 0, 'C');
    $pdf->Cell(27.5, 5, $row2['journal_amount'], 'R', 1, 'C');
}

// Empty lines
for ($i = 0; $i < 4; $i++) {
    $pdf->Cell(25, 15, '', 'LR', 0, 'C');
    $pdf->Cell(5, 15, '', 'L', 0, 'C');
    $pdf->Cell(20, 15, '', '', 0, 'L');
    $pdf->Cell(62, 15, '', 'R', 0, 'L');
    $pdf->Cell(25, 15, '', 'LR', 0, 'C');
    $pdf->Cell(8, 15, '', 'LR', 0, 'C');
    $pdf->Cell(27.5, 15, '', 'LR', 0, 'C');
    $pdf->Cell(27.5, 15, '', 'R', 1, 'C');
}

$pdf->Cell(25, 15, '', 'LBR', 0, 'C');
$pdf->Cell(5, 15, '', 'LB', 0, 'C');
$pdf->Cell(20, 15, '', 'B', 0, 'L');
$pdf->Cell(62, 15, '', 'RB', 0, 'L');
$pdf->Cell(25, 15, '', 'LBR', 0, 'C');
$pdf->Cell(8, 15, '', 'LBR', 0, 'C');
$pdf->Cell(27.5, 15, '', 'LBR', 0, 'C');
$pdf->Cell(27.5, 15, '', 'RB', 1, 'C');

// Footer section with user information
$pdf->SetFont("Arial", '', 8);
$pdf->Cell(65, 5, 'Prepared By:', 'LR', 0, 'L');
$pdf->Cell(80, 5, 'Approved By:', 'R', 0, 'L');
$pdf->Cell(55, 5, 'Posted By:', 'LR', 0, 'L');
$pdf->Ln(5);

$pdf->Cell(65, 10, $data2['user_fname'] . ' ' . $data2['user_mname'] . ' ' . $data2['user_lname'], 'LR', 0, 'C'); // add the user name
$pdf->Cell(80, 10, 'Engr. VICTOR R. OBILLO', 'R', 0, 'C');
$pdf->Cell(55, 10, '', 'LRB', 1, 'C');

$pdf->Cell(65, 10, $data2['userlevel'], 'LR', 0, 'C'); // add the user level
$pdf->Cell(80, 10, 'General Manager', 'R', 0, 'C');
$pdf->Cell(55, 10, '', 'LR', 1, 'C');

$pdf->Cell(65, 10, '', 'LR', 0, 'C');
$pdf->Cell(80, 10, '', 'R', 0, 'C');
$pdf->Cell(55, 10, 'Date', 'LR', 1, 'L');

$pdf->Cell(65, 10, '', 'LRB', 0, 'L');
$pdf->Cell(80, 10, '', 'RB', 0, 'L');
$pdf->Cell(55, 10, '_____________', 'LRB', 1, 'R');

$pdf->Output();
?>
