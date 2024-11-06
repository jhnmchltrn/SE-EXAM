<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

</head>
<style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e9f5f5; /* Light cyan background */
            margin: 0;
            padding: 20px;
        }
        a {
            text-decoration: none;
            color: #0077b6; /* Bright blue */
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
        .form-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
        }
        form p {
            margin-bottom: 15px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="submit"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            border: 1px solid #a4c3b2; /* Soft green border */
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #0077b6; /* Bright blue */
            color: #ffffff;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #005f8b; /* Darker blue */
        }
    </style>
<body>
	<a href="Orders.php?CustomerID=<?php echo $_GET['CustomerID']; ?>">
	View Shipment Records</a>
	<h1>"Change Shipment Information</h1>
	<?php $getShipmentByID = getShipmentByID($pdo, $_GET['OrderID']); ?>
	<form action="core/handleForms.php?OrderID=<?php echo $_GET['OrderID']; ?>
	&CustomerID=<?php echo $_GET['CustomerID']; ?>" method="POST">
		<p>
			<label for="firstName">Shipment Weight</label> 
			<input type="text" name="RiceType" 
			value="<?php echo $getShipmentByID['RiceType']; ?>">
		</p>
		<p>
			<label for="firstName">Shipment Method</label> 
			<input type="text" name="shipmentMethod" 
			value="<?php echo $getShipmentByID['shipmentMethod']; ?>">
		</p>
		<p>
			<label for="firstName">Delivery Address</label> 
			<input type="text" name="WeightOfRice" 
			value="<?php echo $getShipmentByID['WeightOfRice']; ?>">
		</p>
		<p>
			<label for="firstName">Delivery Date</label> 
			<input type="text" name="QuantitySack" 
			value="<?php echo $getShipmentByID['QuantitySack']; ?>">
		</p>
		<p>
			<label for="firstName">RicePrice</label> 
			<input type="text" name="RicePrice" 
			value="<?php echo $getShipmentByID['RicePrice']; ?>">
			<input type="submit" name="editShipmentBtn">
		</p>

	</form>
</body>
</html>