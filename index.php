<?php include("mysql.inc.php"); ?>
<!doctype html>
<html>
<head>
	<title>Council Queue App</title>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css"> <!-- load bootstrap via CDN -->
	<link rel="stylesheet" href="style.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> <!-- load jquery via CDN -->
	<script src="script.js"></script> <!-- load our javascript file -->
</head>
<body>
	<div class="container">
		<h1>Council Queue App</h1>
		<div class="col-sm-6">
			<div class="panel panel-default">
        <div class="panel-heading col-sm-12">
            <h3 class="panel-title">New Customer</h3>
        </div>
				<div class="panel-body" id="newCustomer">
					<div class="row">
						<!-- OUR FORM -->
						<form action="process.php" method="POST">
							<!-- SERVICES -->
							<div id="services-group" class="form-group col-sm-12 lista">
								<label for="services">Services</label>
								<div class="radio radio-primary">
									<input type="radio" name="servicesGroup" id="housing" value="Housing">
									<label for="housing">Housing</label>
								</div>
								<div class="radio radio-primary">
									<input type="radio" name="servicesGroup" id="benefits" value="Benefits">
									<label for="benefits">Benefits</label>
								</div>
								<div class="radio radio-primary">
									<input type="radio" name="servicesGroup" id="council-tax" value="Council Tax">
									<label for="council-tax">Council Tax</label>
								</div>
								<div class="radio radio-primary">
									<input type="radio" name="servicesGroup" id="fly-tipping" value="Fly-tipping">
									<label for="fly-tipping">Fly-tipping</label>
								</div>
								<div class="radio radio-primary">
									<input type="radio" name="servicesGroup" id="missed-bin" value="Missed Bin">
									<label for="missed-bin">Missed Bin</label>
								</div>
								<!-- errors will go here -->
							</div>
							<!-- TYPE -->
							<div id="type-group" class="form-group col-sm-12 lista">
								<label for="type">Type</label>
								<div class="input-group">
    							<div id="radioBtn" class="btn-group">
    								<a class="btn btn-primary btn-sm notActive" data-toggle="typeGroup" data-title="Citizen">Citizen</a>
                    <a class="btn btn-primary btn-sm notActive" data-toggle="typeGroup" data-title="Organisation">Organisation</a>
    								<a class="btn btn-primary btn-sm notActive" data-toggle="typeGroup" data-title="Anonymous">Anonymous</a>
    						</div>
    						<input type="hidden" name="typeGroup" id="typeGroup">
    					</div>


								<!-- errors will go here -->
							</div>
							<!-- TITLE -->
							<div id="title-group" class="form-group col-sm-12 lista">
							  <label for="titleGroup">Title</label>
							    <select id="selectTitleGroup" name="titleGroup" class="form-control">
							      <option value="Mr.">Mr.</option>
							      <option value="Mrs.">Mrs.</option>
							      <option value="Ms.">Ms.</option>
										<option value="Miss">Miss</option>
							    </select>
							<!-- errors will go here -->
							</div>
							<!-- FIRST NAME -->
							<div id="firstname-field" class="form-group col-sm-12 lista">
								<label for="firstname">First Name</label>
								<input type="text" class="form-control" name="firstname" placeholder="First Name">
								<!-- errors will go here -->
							</div>
							<!-- LAST NAME -->
							<div id="lastname-field" class="form-group col-sm-12 lista">
								<label for="lastname">Last Name</label>
								<input type="text" class="form-control" name="lastname" placeholder="Last Name">
								<!-- errors will go here -->
							</div>
							<div class="form-group col-sm-12 lista">
								<button type="submit" class="btn btn-info">Submit</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="panel panel-default">
          <div class="panel-heading col-sm-12">
              <h3 class="panel-title">Queue</h3>
          </div>
					<div class="panel-body">
						<div class="row">
							<div class="col-sm-12" id="queue">
								<div class="row head">
									<div class="col-xs-1 col-sm-1">#</div>
									<div class="col-xs-2 col-sm-2">Type</div>
									<div class="col-xs-4 col-sm-4">Name</div>
									<div class="col-xs-3 col-sm-3">Service</div>
									<div class="col-xs-1 col-sm-1">Time</div>
								</div>
							<!-- retrieve data from db -->
							<?php
								$sql = "SELECT * FROM queue_app";

								$result = mysqli_query($conn, $sql);

								if (mysqli_num_rows($result) > 0) {
								    // output data of each row
										$count = 1;
								    while($row = mysqli_fetch_assoc($result)) {
											if($row["type"] == "Anonymous" || $row["type"] == "Organisation"){
												$row["title"] = "";
												$row["last_name"] = "";
											}
											echo "<div class=\"row lista\"><div class=\"col-xs-1 col-sm-1\">" . $count . "</div><div class=\"col-xs-2 col-sm-2\">" . $row["type"] .
											"</div><div class=\"col-xs-4 col-sm-4\">" . $row["title"] . " " . $row["first_name"] . " " . $row["last_name"] .
											"</div><div class=\"col-xs-3 col-sm-3\">" .	$row["services"] . "</div><div class=\"col-xs-1 col-sm-1\">" .
											substr($row["time_reg"], 0, 5) . "</div></div>";
											$count++;
										}
								}
								mysqli_close($conn);
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
