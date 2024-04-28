<!DOCTYPE html>
<html>
<head>
	<title>Internet Banking Admin Pannel</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
	<header>
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="home.php">Internet Banking Website</a>
				</div>
				<div class="collapse navbar-collapse" id="myNavbar">
					<ul class="nav navbar-nav">
						<li><a href="/mobile_banking/admins/home.php">Home</a></li>
						<li><a href="/mobile_banking/admins/transactionType/transactionTypeList.php">Transaction Types</a></li>
						<li><a href="/mobile_banking/admins/typeOfLoan/typeOfLoanList.php">Type Of Loan</a></li>
						<li><a href="/mobile_banking/admins/wallets/cashIn.php">Cash In</a></li>
						<li><a href="/mobile_banking/admins/updateProfile.php">Update Info</a></li>
						<li><a href="/mobile_banking/admins/banks/bankList.php">Branches</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="/mobile_banking/admins/loans/loanList.php">Loan List</a></li>
						<li><a href="/mobile_banking/admins/transactions.php">Transactions</a></li>
						<li><a href="/mobile_banking/admins/register.php">Create Staff Account</a></li>
						<li><a href="/mobile_banking/admins/logout.php">Logout</a></li>
					</ul>
				</div>
			</div>
		</nav>
	</header>
</body>
</html>
