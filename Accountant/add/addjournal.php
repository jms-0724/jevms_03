<?php
session_start();
require(__DIR__ . "/../../connections/connection.php");

$data = file_get_contents('php://input');

$jsondecoded = json_decode($data, true);
$datetoday = date('Y/m/d');
if (isset($jsondecoded['add_journal_number'])) {

    $conn->beginTransaction();

    try {

        $uid = $_SESSION['userid'];
        $add_journal_date = $datetoday;
        $add_journal_number = $jsondecoded['add_journal_number'];
        $add_journal_description = $jsondecoded['add_journal_description'];
        $add_journal_category = $jsondecoded['add_journal_category'];

        $sql1 = $conn->prepare("INSERT INTO tbl_journal_entry (journal_voucher_no, journal_date, description, category_id, uid) VALUES (:journal_voucher_no, :journal_date, :description, :category_id, :uid)");
        $sql1->bindParam(':journal_voucher_no', $add_journal_number);
        $sql1->bindParam(':journal_date', $add_journal_date);
        $sql1->bindParam(':description', $add_journal_description);
        $sql1->bindParam(':category_id', $add_journal_category);
        $sql1->bindParam(':uid', $uid);
        
        

        if ($sql1->execute()) {
            $last_id = $conn->lastInsertId();
            $_SESSION['jevNumber'] = $last_id;  // Store the last inserted ID in session
            

            // $descSQL = $conn->prepare("INSERT INTO tbl_description (desc_text) VALUES(:desc_text)");
            // $descSQL->bindParam(':desc_text', $add_journal_description);
            // $descSQL->execute();
            foreach ($jsondecoded['journal_array'] as $row) {
                $account_code = $row['account_code'];
                $journal_amount = $row['journal_amount'];
                $journal_placement = $row['journal_placement'];
                $sql2 = $conn->prepare("INSERT INTO tbl_journal_items (journal_voucher_id, account_code, journal_amount, journal_adjustment) VALUES (:last_id, :account_code, :journal_amount, :journal_placement)");
                $sql2->bindParam(":last_id", $last_id);
                $sql2->bindParam(":account_code", $account_code);
                $sql2->bindParam(":journal_amount", $journal_amount);
                $sql2->bindParam(":journal_placement", $journal_placement);

                if ($sql2->execute()) {
                    // Do nothing here, just continue to the next iteration
                    $dbt = "Debit";
                    $crt = "Credit";

                    // Insert for Debit
                    $sql3 = $conn->prepare("INSERT INTO tbl_general_ledger (ledger_date, account_code, debit, description, journal_voucher_id) VALUES(:ledger_date, :account_code, :debit, :description, :journal_voucher_id)");
                    $sql3->bindParam(":ledger_date", $datetoday);
                    $sql3->bindParam(":account_code", $account_code);
                    $sql3->bindParam(":debit", $journal_amount);
                    $sql3->bindParam(":description", $add_journal_description);
                    $sql3->bindParam(":journal_voucher_id", $last_id);

                    // Insert for Credit Legder
                    $sql4 = $conn->prepare("INSERT INTO tbl_general_ledger (ledger_date, account_code, credit, description, journal_voucher_id) VALUES(:ledger_date, :account_code, :credit, :description, :journal_voucher_id)");
                    $sql4->bindParam(":ledger_date", $datetoday);
                    $sql4->bindParam(":account_code", $account_code);
                    $sql4->bindParam(":credit", $journal_amount);
                    $sql4->bindParam(":description", $add_journal_description);
                    $sql4->bindParam(":journal_voucher_id", $last_id);

                                       
                    if ($journal_placement === $dbt) {
                        $sql3->execute();
                        $last_id2 = $conn->lastInsertId();
                        // Insert for Debit Balance
                    $sql5 = $conn->prepare("INSERT INTO tbl_trial_balance (ledger_id, account_code, total_debit, trial_balance_date) VALUES(:ledger_id, :account_code, :total_debit, :trial_balance_date)");
                    $sql5->bindParam(":ledger_id", $last_id2);
                    $sql5->bindParam(":account_code", $account_code);
                    $sql5->bindParam(":total_debit", $journal_amount);
                    $sql5->bindParam(":trial_balance_date", $datetoday);
                    $sql5->execute();
                    } elseif ($journal_placement  === $crt){
                        $sql4->execute();
                        $last_id2 = $conn->lastInsertId();
                         // Insert for credit balance
                    $sql6 = $conn->prepare("INSERT INTO tbl_trial_balance (ledger_id, account_code, total_credit, trial_balance_date) VALUES(:ledger_id, :account_code, :total_credit, :trial_balance_date)");
                    $sql6->bindParam(":ledger_id", $last_id2);
                    $sql6->bindParam(":account_code", $account_code);
                    $sql6->bindParam(":total_credit", $journal_amount);
                    $sql6->bindParam(":trial_balance_date", $datetoday);
                    $sql6->execute();
                        
                    }

                } else {
                    // If any of the second query executions fail, roll back the transaction
                    $conn->rollBack();
                    echo "Failed";
                    exit(); // Terminate script execution
                }
            }

            // If all queries are successful, commit the transaction
            $conn->commit();
            echo "Success";
           
        } else {
            // If the first query execution fails, roll back the transaction
            $conn->rollBack();
            echo "Failed";
        }
    } catch (Exception $e) {
        // Catch any exceptions and roll back the transaction
        $conn->rollBack();
        echo "Transaction Failed" . $e->getMessage();
    }
} else {
    echo "Not Set";
}

?>
