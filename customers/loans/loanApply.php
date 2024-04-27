<?php 
	include("../../connection.php");
    session_start(); 
    include("../authCheck.php");

    $customer_id = $_SESSION['customer_id'];
    $query = "SELECT * FROM wallets WHERE customer_id='$customer_id'";
    $result = mysqli_query($connect, $query);

    $qry = "SELECT * FROM type_of_loan";
    $l_type = mysqli_query($connect, $qry);    

	if(isset($_POST['btnSave'])){
		$loan_start_date = $_POST['txtStartDate'];
		$loan_end_date = $_POST['txtEndDate'];
		$amount = $_POST['txtAmount'];
		$wallet_id = $_POST['selWalletId'];
		$type_of_loan_id = $_POST['selTypeOfLoanId'];
        $loan_description = $_POST['txtDescription'];
        $loan_status = 'pending';

		//---Upload Img---
		$filePolice=$_FILES['filePolice']['name'];
		$Destination="../../images/loans/policeRecommendationLetter/";
		$police_recommendation_letter=$Destination .$wallet_id . date('Y-m-d-h-i-s') ."_". $filePolice;
        $copied = copy($_FILES['filePolice']['tmp_name'], $police_recommendation_letter);
        if(!$copied){
			echo"<p>Error Uploading Police Recommendation Letter</p>";
			exit();
		}
		//----------------

        //---Upload Img---
		$fileWork=$_FILES['fileWork']['name'];
		$Destination="../../images/loans/workRecommendationLetter/";
		$work_recommendation_letter=$Destination .$wallet_id . date('Y-m-d-h-i-s') ."_". $fileWork;
		$copied = copy($_FILES['fileWork']['tmp_name'], $work_recommendation_letter);
		if(!$copied){
			echo"<p>Error Uploading Work Recommendation Letter</p>";
			exit();
		}
		//----------------

        $insertQuery = "INSERT INTO loans(amount, type_of_loan_id, loan_start_date, loan_end_date, loan_status, loan_description, police_recommendation_letter, work_recommendation_letter, wallet_id)
			VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
			$insertStmt = mysqli_prepare($connect, $insertQuery);
			mysqli_stmt_bind_param($insertStmt, 'iissssssi', $amount, $type_of_loan_id, $loan_start_date, $loan_end_date, $loan_status, $loan_description, $police_recommendation_letter, $work_recommendation_letter, $wallet_id);
			$res1 = mysqli_stmt_execute($insertStmt);
			if(!$res1){
				echo"<p>Opps! Something went wrong".mysqli_error($connect)."</p>";
			}
			else{
				echo"<script>window.alert('Loan Form Submitted')</script>";
				echo"<script>window.location='loanList.php?wid=$wallet_id'</script>";
			}
		
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<form action="loanApply.php" method = "POST" enctype="multipart/form-data">
		<fieldset>
		<legend>Loan Form</legend>
		<table>
			<tr>
				<td>Start Date</td>
				<td>
					<input type="date" name="txtStartDate" required>
				</td>
			</tr>
			<tr>
				<td>End Date</td>
				<td>
					<input type="date" name="txtEndDate" required>
				</td>
			</tr>
            <tr>
				<td>Amount</td>
				<td>
					<input type="number" name="txtAmount" required placeholder="1000.00">
				</td>
			</tr>
            <tr>
				<td>Recipent Wallet</td>
				<td>
                    <select name="selWalletId" id="selWalletId" required>
                        <option value="">SELECT WALLET</option>
                        <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                $wallet_id = $row['wallet_id'];
                                $wallet_number = $row['wallet_number'];
                                echo "<option value=\"$wallet_id\">$wallet_number</option>";
                            }
                        ?>
                    </select>
				</td>
			</tr>
            <tr>
				<td>Loan Type</td>
				<td>
                    <select name="selTypeOfLoanId" id="selTypeOfLoanId" required>
                        <option value="">SELECT LOAN TYPE</option>
                        <?php
                            while ($type = mysqli_fetch_assoc($l_type)) {
                                $type_of_loan_id = $type['type_of_loan_id'];
                                $type_of_loan = $type['type_of_loan'];
                                echo "<option value=\"$type_of_loan_id\">$type_of_loan</option>";
                            }
                        ?>
                    </select>
				</td>
			</tr>
			</tr>
			<tr>
				<td>Police Recommendation Letter</td>
				<td>
					<input type="file" name="filePolice" required>
				</td>
			</tr>
            <tr>
				<td>Work Recommendation Letter</td>
				<td>
					<input type="file" name="fileWork" required>
				</td>
			</tr>
            <tr>
				<td>Description</td>
				<td>
                    <textarea name="txtDescription" id="txtDescription" cols="40" rows="5"></textarea>
				</td>
			</tr>
			<tr><td></td>
				<td>
					<input type="submit" name="btnSave" value="Apply" />
					<input type="reset" value="Cancel" />
				</td>
			</tr>
		</table>
		</fieldset>
	</form>
</body>
</html>