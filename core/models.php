<?php  

function insertClient($pdo, $CustomerName, $ContactNumber, $Email, 
	$Address, $City) {

	$sql = "INSERT INTO Customer (CustomerName, ContactNumber, Email, 
		Address, City) VALUES(?,?,?,?,?)";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$CustomerName, $ContactNumber, $Email, 
	$Address, $City]);

	if ($executeQuery) {
		return true;
	}
}



function updateClient($pdo, $ContactNumber, $Email, 
	$Address, $City, $CustomerID) {

	$sql = "UPDATE Customer
				SET ContactNumber = ?,
					Email = ?,
					Address = ?, 
					City = ?
				WHERE CustomerID = ?
			";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$ContactNumber, $Email, 
	$Address, $City, $CustomerID]);
	
	if ($executeQuery) {
		return true;
	}

}


function deleteCustomer($pdo, $CustomerID) {
	$deleteOder = "DELETE FROM Orders WHERE CustomerID = ?";
	$deleteStmt = $pdo->prepare($deleteOder);
	$executeDeleteQuery = $deleteStmt->execute([$CustomerID]);

	if ($executeDeleteQuery) {
		$sql = "DELETE FROM Customer WHERE CustomerID = ?";
		$stmt = $pdo->prepare($sql);
		$executeQuery = $stmt->execute([$CustomerID]);

		if ($executeQuery) {
			return true;
		}

	}
	
}




function getAllCustomer($pdo) {
	$sql = "SELECT * FROM Customer";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getClientByID($pdo, $CustomerID) {
	$sql = "SELECT * FROM Customer WHERE CustomerID = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$CustomerID]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
}





function getShipmentByClient($pdo, $CustomerID) {
	
	$sql = "SELECT 
				Orders.OrderID AS OrderID,
				Orders.RiceType AS RiceType,
				Orders.shipmentMethod AS shipmentMethod,
				Orders.WeightOfRice AS WeightOfRice,
				Orders.QuantitySack AS QuantitySack,
				Orders.RicePrice AS RicePrice,
				Orders.dateRegistered AS dateRegistered,
				Customer.CustomerName AS CustomerName
			FROM Orders
			JOIN Customer ON Orders.CustomerID = Customer.CustomerID
			WHERE Orders.CustomerID = ? 
			GROUP BY Orders.RiceType;
			";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$CustomerID]);
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}


function insertShipment($pdo, $RiceType, $shipmentMethod, $WeightOfRice, $QuantitySack, $RicePrice, $CustomerID) {
	$sql = "INSERT INTO Orders (RiceType, shipmentMethod, WeightOfRice, QuantitySack, RicePrice, CustomerID) VALUES (?,?,?,?,?,?)";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$RiceType, $shipmentMethod, $WeightOfRice, $QuantitySack, $RicePrice, $CustomerID]);
	if ($executeQuery) {
		return true;
	}

}

function getShipmentByID($pdo, $OrderID) {
	$sql = "SELECT 
				Orders.OrderID AS OrderID,
				Orders.RiceType AS RiceType,
				Orders.shipmentMethod AS shipmentMethod,
				Orders.WeightOfRice AS WeightOfRice,
				Orders.QuantitySack AS QuantitySack,
				Orders.RicePrice AS RicePrice,
				Orders.dateRegistered AS dateRegistered,
				Customer.CustomerName AS CustomerName
			FROM Orders
			JOIN Customer ON Orders.CustomerID = Customer.CustomerID
			WHERE Orders.OrderID  = ? 
			GROUP BY Orders.RiceType";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$OrderID]);
	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function updateShipment($pdo, $RiceType, $shipmentMethod, $WeightOfRice, $QuantitySack, $RicePrice, $OrderID) {
	$sql = "UPDATE Orders
			SET RiceType = ?,
				shipmentMethod = ?,
				WeightOfRice = ?,
				QuantitySack = ?,
				RicePrice = ?
			WHERE OrderID = ?
			";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$RiceType, $shipmentMethod, $WeightOfRice, $QuantitySack, $RicePrice, $OrderID]);

	if ($executeQuery) {
		return true;
	}
}

function deleteOrder($pdo, $OrderID) {
	$sql = "DELETE FROM Orders WHERE OrderID = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$OrderID]);
	if ($executeQuery) {
		return true;
	}
}


function getAllOrderByCustomerID($CustomerID) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM Customer WHERE CustomerID = :CustomerID");
    $stmt->execute(['CustomerID' => $CustomerID]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


function registerCustomer($pdo, $customer_name, $username, $password) {
    try {
        $stmt = $pdo->prepare("INSERT INTO customers (customer_name, username, password) VALUES (?, ?, ?)");
        return $stmt->execute([$customer_name, $username, $password]);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}

function getUserByUsername($pdo, $username) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM customers WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}
?>