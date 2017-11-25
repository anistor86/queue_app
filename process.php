<?php


$errors         = array();  	// array to hold validation errors
$data 			= array(); 		// array to pass back data
// validate the variables ======================================================
	// if any of these variables don't exist, add an error to our $errors array
	if (empty($_POST['services']))
		$errors['services'] = 'Service is required.';
	if (empty($_POST['type']))
		$errors['type'] = 'Choose a type, please!.';
	if (empty($_POST['titleGroup']))
		$errors['titleGroup'] = 'Choose a title, please!';
	if (empty($_POST['firstname']))
		$errors['firstname'] = 'Choose a first name, please!';
	if (empty($_POST['lastname']))
		$errors['lastname'] = 'Choose a last name, please!';
// return a response ===========================================================
	// if there are any errors in our errors array, return a success boolean of false
	if ( ! empty($errors)) {
		// if there are items in our errors array, return those errors
		$data['success'] = false;
		$data['errors']  = $errors;
	} else {

		// if there are no errors process our form, then return a message
		// DO ALL YOUR FORM PROCESSING HERE
		// THIS CAN BE WHATEVER YOU WANT TO DO (LOGIN, SAVE, UPDATE, WHATEVER)
		// show a message of success and provide a true success variable



		include("mysql.inc.php");

		$services = $_POST['services'];
		$type = $_POST['type'];
		$title_group = trim($_POST['titleGroup']);
		$first_name = mysqli_real_escape_string($conn, trim($_POST['firstname']));
		$last_name = mysqli_real_escape_string($conn, trim($_POST['lastname']));
		$time_reg = date('H:i:s');

		$sql = "INSERT INTO queue_app ";
		$sql .= "(services, type, title, first_name, last_name, time_reg) ";
		$sql .= "VALUES ('$services', '$type', '$title_group', '$first_name' ,'$last_name', '$time_reg')";



		//$result = $conn->query($sql);

		if (mysqli_query($conn, $sql)) {
				$result = mysqli_query($conn, "SELECT * FROM queue_app");
				$count = mysqli_num_rows($result);

				$data['success'] = true;
				$data['message'] = 'Success!';
				$data['count'] = $count;
				$data['services'] = $services;
				$data['type'] = $type;
				$data['title_group'] = $title_group;
				$data['first_name'] = stripslashes($first_name);
				$data['last_name'] = stripslashes($last_name);
				$data['time_reg'] = $time_reg;
		} else {
				$errors['database'] = 'Db Error.';
				$data['dbInsert'] = 'Fail!';
				$data['success'] = false;
				$data['errors']  = $errors;
		}
		$conn->close();
	}
	// return all our data to an AJAX call

	echo json_encode($data);

	?>
