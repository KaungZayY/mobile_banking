<?php 
    include("../header.php");
    include("../../connection.php");
    session_start(); 
    include("../authCheck.php");

    if(isset($_REQUEST['tid'])){
		$type_of_loan_id=$_REQUEST['tid'];
		$select="SELECT * FROM type_of_loan WHERE type_of_loan_id=?";
		$stmt = mysqli_prepare($connect, $select);
		mysqli_stmt_bind_param($stmt, "i", $type_of_loan_id);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		$data = mysqli_fetch_array($result);
		$type_of_loan_id=$data['type_of_loan_id'];
		$type_of_loan=$data['type_of_loan'];
		$rate=$data['rate'];
	}

    if (isset($_POST['btnUpdate'])) {
		$type_of_loan_id=$_POST['txtId'];
		$type_of_loan=$_POST['txtTypeOfLoan'];
		$rate=$_POST['txtRate'];
		$update="UPDATE type_of_loan SET type_of_loan=?, rate=? WHERE type_of_loan_id=?";
		$stmt = mysqli_prepare($connect, $update);
		mysqli_stmt_bind_param($stmt, "sii", $type_of_loan, $rate, $type_of_loan_id);
		$query1=mysqli_stmt_execute($stmt);
		if ($query1) {
			echo "<script>alert('Update Successful')
			window.location='typeOfLoanList.php'
			</script>";
		}
        else{
            echo "<script>alert('Update Failed')
			window.location='typeOfLoanList.php'
			</script>";
        }
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        form {
            width: 50%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        fieldset {
            border: none;
            margin: 0;
            padding: 0;
        }
        legend {
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 20px;
        }
        table {
            width: 100%;
        }
        table tr {
            margin-bottom: 15px;
        }
        table td:first-child {
            width: 30%;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }
        input[type="submit"], input[type="reset"] {
            padding: 10px 20px;
            border: none;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            border-radius: 3px;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover, input[type="reset"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
	<form action="typeOfLoanUpdate.php" method = "POST">
		<fieldset>
		<legend>Update Loan Type</legend>
		<table>
			<tr>
				<td>Loan Type</td>
				<td>
					<input type="hidden" name="txtId" required value="<?php echo $type_of_loan_id; ?>">
					<input type="text" name="txtTypeOfLoan" required placeholder="6 months" value="<?php echo $type_of_loan; ?>">
				</td>
			</tr>
            <tr>
			    <td>Interest Rate</td>
				<td>
					<input type="number" name="txtRate" required placeholder="5 %" value="<?php echo $rate; ?>">
				</td>
			</tr>

			<tr><td></td>
				<td>
					<input type="submit" name="btnUpdate" value="Update" />
					<input type="reset" value="Cancel" />
				</td>
			</tr>
		</table>
		</fieldset>
	</form>
</body>
</html>

<?php
    include('../../footer.php');