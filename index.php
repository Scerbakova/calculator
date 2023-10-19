<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/main.css">
	<title>PHP Calculator</title>
</head>

<body>
	<form class="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		<!-- sending sanitized data to the same page -->
		<div>
			<label class="label" for="num01">Number 1</label>
			<input class="input__number" type="number" name="num01">
		</div>

		<div class="d">
			<label class="label" for="operator">Operator</label>
			<select class="select__operator" name="operator">
				<option value="+">+</option>
				<option value="-">-</option>
				<option value="*">*</option>
				<option value="/">/</option>
			</select>
		</div>

		<div>
			<label class="label" for="num02">Number 2</label>
			<input class="input__number" type="number" name="num02">
		</div>
		<button class="button__calculate">Calculate</button>

	</form>

	<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$num01 = filter_input(INPUT_POST, "num01", FILTER_SANITIZE_NUMBER_FLOAT);
		$num02 = filter_input(INPUT_POST, "num02", FILTER_SANITIZE_NUMBER_FLOAT);
		$operator = htmlspecialchars($_POST["operator"]);

		$errors = false;

		if (empty($num01) || empty($num02 || empty($operator))) {
			echo "<p class='error'>Please fill out all the fields</p>";
			$errors = true;
		}
		if (!is_numeric($num01) || !is_numeric($num02)) {
			echo "<p class='error'>Please enter a valid number</p>";
			$errors = true;
		}
		$result = 0;
		if (!$errors) {
			switch ($operator) {
				case "+":
					$result = $num01 + $num02;
					break;
				case "-":
					$result = $num01 - $num02;
					break;
				case "*":
					$result =  $num01 * $num02;
					break;
				case "/":
					$result = $num01 / $num02;
					break;
				default:
					echo "<p class='error'>Something went wrong</p>";
			}
			echo "<p class='result'>Result = " . $result . "</p>";
		}
	}
	?>
</body>

</html>