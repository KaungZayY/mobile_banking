<?php 
    include("../header.php");
    include("../../connection.php");
    session_start(); 
    include("../authCheck.php");

	if(isset($_POST['btnSave'])){
		$txtPrefixCode = $_POST['txtPrefixCode'];
		$txtAddress = $_POST['txtAddress'];

		//------check branch already exists
		$checkBranch = "SELECT * FROM banks WHERE prefix_code=? AND bank_address=?";
		$stmt = mysqli_prepare($connect, $checkBranch);
		mysqli_stmt_bind_param($stmt, 'ss', $txtPrefixCode, $txtAddress);
		mysqli_stmt_execute($stmt);
		$res = mysqli_stmt_get_result($stmt);
		if($res === false){
			echo"Error: ".mysqli_error($connect);
		}
		elseif (mysqli_num_rows($res) > 0){
			echo"<script>window.alert('Branch with Prefix Code Already Exist')</script>";
			echo"<script>window.location='bankCreate.php'</script>";
		}
		else{
			$insertQuery = "INSERT INTO banks (prefix_code, bank_address)
			VALUES (?, ?)";
			$insertStmt = mysqli_prepare($connect, $insertQuery);
			mysqli_stmt_bind_param($insertStmt, 'ss', $txtPrefixCode, $txtAddress);
			$res1 = mysqli_stmt_execute($insertStmt);
			if(!$res1){
				echo"<p>Opps! Something went wrong".mysqli_error($connect)."</p>";
			}
			else{
				echo"<script>window.alert('New Branch Added')</script>";
				echo"<script>window.location='bankList.php'</script>";
			}
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
	<form action="bankCreate.php" method = "POST">
		<fieldset>
		<legend>Add New Branch</legend>
		<table>
			<tr>
				<td>Prefix Code</td>
				<td>
					<input type="text" name="txtPrefixCode" required placeholder="110011">
				</td>
			</tr>
            <tr>
			    <td>Address</td>
				<td>
					<input type="text" name="txtAddress" required placeholder="No-2 Baho Street Yangon">
				</td>
			</tr>

			<tr><td></td>
				<td>
					<input type="submit" name="btnSave" value="Save" />
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