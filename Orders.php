<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders Management</title>
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
        header {
            width: 100%;
            background-color: #e9f5f5; /* Dark background for header */
            padding: 15px 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5);
            margin-bottom: 20px; /* Space between header and content */
        }
        header a {
            color: #03ADC5; /* Bright accent color for links */
            margin-right: 20px; /* Space between links */
            font-size: 16px; /* Font size for header links */
        }
        header a:hover {
            color: #018da0; /* Darker shade on hover */
        }
        .client {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: auto;
            margin-bottom: 20px;
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
        table {
            width: 85%;
            margin: 50px auto 0;
            border-collapse: collapse;
            background-color: #ffffff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #0077b6; /* Bright blue */
            color: #ffffff;
            font-weight: bold;
        }
        td a {
            margin-right: 10px;
        }
        td a:first-child {
            color: #3fa34d; /* Green for edit link */
        }
        td a:last-child {
            color: #d62828; /* Red for delete link */
        }
        tr:nth-child(even) {
            background-color: #f1fafa; /* Light cyan row */
        }
        tr:hover {
            background-color: #d1f1f1; /* Light blue hover */
        }
    </style>
</head>
<body>
    <header>
        <a href="index.php">Return to home</a>
        <a href="">About Us</a> 
        <a href="">Contact</a> 
    </header>
	
	<?php $getAllOrderByCustomerID = getAllOrderByCustomerID($_GET['CustomerID']); ?>
	<div class="client" style="text-align: left;">
		<h3 style="margin-bottom: 10px;">Add New Shipment</h3>
		<form action="core/handleForms.php?CustomerID=<?php echo $_GET['CustomerID']; ?>" method="POST">
			<p>
				<label for="RiceType">Rice Type</label> 
				<input type="text" name="RiceType" required>
			</p>
			<p>
				<label for="shipmentMethod">Shipment Method</label> 
				<input type="text" name="shipmentMethod" required>
			</p>
			<p>
				<label for="WeightOfRice">Weight of Rice</label> 
				<input type="text" name="WeightOfRice" required>
			</p>
			<p>
				<label for="QuantitySack">Quantity Sack</label> 
				<input type="text" name="QuantitySack" required>
			</p>
			<p>
				<label for="RicePrice">Rice Price</label> 
				<input type="text" name="RicePrice" required>
			</p>
			<input type="submit" name="insertNewShipmentBtn" value="Add Shipment">
		</form>
	</div>

	<table style="width:85%; margin-top: 50px;">
	  <tr>
	    <th>Order ID</th>
	    <th>Rice Type</th>
		<th>Shipment Method</th>
	    <th>Weight of Rice</th>
		<th>Quantity Sack</th>
		<th>Rice Price</th>
	    <th>Customer Name</th>
	    <th>Shipment Date</th>
	    <th>Action</th>
	  </tr>
	  <?php $getShipmentByClient = getShipmentByClient($pdo, $_GET['CustomerID']); ?>
	  <?php foreach ($getShipmentByClient as $row) { ?>
	  <tr>
	  	<td><?php echo $row['OrderID']; ?></td>	  	
	  	<td><?php echo $row['RiceType']; ?></td>	  
		<td><?php echo $row['shipmentMethod']; ?></td>	 	
	  	<td><?php echo $row['WeightOfRice']; ?></td>
		<td><?php echo $row['QuantitySack']; ?></td>	
		<td><?php echo $row['RicePrice']; ?></td>	  	  	
	  	<td><?php echo $row['CustomerName']; ?></td>	  	
	  	<td><?php echo $row['dateRegistered']; ?></td>
	  	<td>
	  		<a href="editOrder.php?OrderID=<?php echo $row['OrderID']; ?>&CustomerID=<?php echo $_GET['CustomerID']; ?>">Edit</a>
	  		<a href="deleteOrder.php?OrderID=<?php echo $row['OrderID']; ?>&CustomerID=<?php echo $_GET['CustomerID']; ?>">Delete</a>
	  	</td>	  	
	  </tr>
	<?php } ?>
	</table>
</body>
</html>
