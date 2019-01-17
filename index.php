
<!DOCTYPE html>
<?php
	$result=null;
	$intA=null;
	$intB=null;

	if (!empty($_POST)) {
		if (isset($_POST['intA']) && isset($_POST['intB'])
			&& isset($_POST['operation'])) {
			$operation = $_POST['operation'];
			$intA = $_POST['intA'];
			$intB = $_POST['intB'];
			$arguments = array('intA'=>$intA, 'intB'=>$intB);

			switch ($operation) {
				case 'add':
					$result = add($arguments);
					break;

				case 'subtract':
					$result = subtract($arguments);
					break;

				case 'multiply':
					$result = multiply($arguments);
					break;

				case 'divide':
					$result = divide($arguments);
					break;
			}
		}

		if (isset($_POST['reset'])) {
			$intA=$intB=$result=null;
		}
	}

	function add($parameters) {
		$client = new SoapClient("http://www.dneonline.com/calculator.asmx?wsdl");
		$result = $client->Add($parameters)->AddResult;
		return $result;
	}

	function subtract($parameters) {
		$client = new SoapClient("http://www.dneonline.com/calculator.asmx?wsdl");
		$result = $client->Subtract($parameters)->SubtractResult;
		return $result;
	}

	function multiply($parameters) {
		$client = new SoapClient("http://www.dneonline.com/calculator.asmx?wsdl");
		$result = $client->Multiply($parameters)->MultiplyResult;
		return $result;
	}

	function divide($parameters) {
		$client = new SoapClient("http://www.dneonline.com/calculator.asmx?wsdl");
		$result = $client->Divide($parameters)->DivideResult;
		return $result;
	}



?>

<html lang="en" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title></title>
	</head>
	<body>
		<main>
			<h2>Welcome to calculator</h2>
			<form method="post">
				<select name="operation">
					<option value="add" selected="selected">Add</option>
					<option value="subtract">Subtract</option>
					<option value="multiply">Multiply</option>
					<option value="divide">Divide</option>
				</select>

				<input type="number" name="intA" value="<?php if($intA!=null) echo $intA; ?>">
				<input type="number" name="intB" value="<?php if($intB!=null) echo $intB; ?>">
				<br/>
				<br/>
				<input type="submit" value="Send">
				<input type="submit" value="Reset" name="reset">
				<br/>
				<br/>
				Result <br/>
				<input type="number" value="<?php if($result!=null) echo $result; ?>">
			</form>
		</main>
	</body>
</html>
