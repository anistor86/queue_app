
$(document).ready(function() {

	//reset function
	$.fn.resetFunction = function(){
		$('input[name=firstname]').val('');
		$('input[name=firstname]').val('');
		$('input[name=servicesGroup]').prop('checked', false);
		$('a[data-toggle="typeGroup"][data-title="Citizen"]').removeClass('active').addClass('notActive');
		$('a[data-toggle="typeGroup"][data-title="Organisation"]').removeClass('active').addClass('notActive');
		$('a[data-toggle="typeGroup"][data-title="Anonymous"]').removeClass('active').addClass('notActive');
		$('#firstname-field').show();
		$('#title-group').show();
		$('#lastname-field').show();
		$('label[for=firstname]').text('First Name');
		$('input[name=firstname]').attr('placeholder', 'First Name');
		$('input[name=firstname]').val('');
		$('input[name=lastname]').val('');
  };

	//toggle button
	$('#radioBtn a').on('click', function(){
			$('#mess').remove();
	    var sel = $(this).data('title');
	    var tog = $(this).data('toggle');
	    $('#'+tog).prop('value', sel);

	    $('a[data-toggle="'+tog+'"]').not('[data-title="'+sel+'"]').removeClass('active').addClass('notActive');
	    $('a[data-toggle="'+tog+'"][data-title="'+sel+'"]').removeClass('notActive').addClass('active');

			switch(sel){
				case "Anonymous":
						$('#firstname-field').hide();
						$('input[name=firstname]').val('Anonymous');
						$('#lastname-field').hide();
						$('input[name=lastname]').val('#');
						$('#title-group').hide();
						$('input[name=firstname]').attr('placeholder', '');
						break;
				case "Organisation":
						$('#firstname-field').show();
						$('#title-group').hide();
						$('label[for=firstname]').text('Name');
						$('#lastname-field').hide();
						$('input[name=lastname]').val('#');
						$('input[name=firstname]').val('');
						$('input[name=firstname]').attr('placeholder', 'Organisation');
						break;
				case "Citizen":
						$('#firstname-field').show();
						$('#title-group').show();
						$('#lastname-field').show();
						$('label[for=firstname]').text('First Name');
						$('input[name=firstname]').val('');
						$('input[name=lastname]').val('');
						$('input[name=firstname]').attr('placeholder', 'First Name');
						break;
			}

	})

	//clear message
	$('form').on("focusin", function(){
		$('#mess').remove();
	});

	// process the form
	$('form').submit(function(event) {

		$('.form-group').removeClass('has-error'); // remove the error class
		$('.help-block').remove(); // remove the error text
		$('#mess').remove();

		// get the form data
		// there are many ways to get this data using jQuery (you can use the class or id also)
		var formData = {
			'services' 		: $('input[name=servicesGroup]:checked').val(),
			'type' 			 	: $('input[name=typeGroup]').val(),
			'titleGroup' 	: $('select[name=titleGroup]').val(),
			'firstname'   : $('input[name=firstname]').val(),
			'lastname' 	  : $('input[name=lastname]').val()


		};

		// process the form
		$.ajax({
			type 		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
			url 		: 'process.php', // the url where we want to POST
			data 		: formData, // our data object
			dataType 	: 'json', // what type of data do we expect back from the server
			encode 		: true
		})
			// using the done promise callback
			.done(function(data) {

				// log data to the console so we can see
				console.log(data);

				// here we will handle errors and validation messages
				if ( ! data.success) {

					// handle errors for services ---------------
					if (data.errors.services) {
						$('#services-group').addClass('has-error'); // add the error class to show red input
						$('#services-group').append('<div class="help-block">' + data.errors.services + '</div>'); // add the actual error message under our input
					}

					// handle errors for type ---------------
					if (data.errors.type) {
						$('#type-group').addClass('has-error'); // add the error class to show red input
						$('#type-group').append('<div class="help-block">' + data.errors.type + '</div>'); // add the actual error message under our input
					}

					// handle errors for title ---------------
					if (data.errors.title) {
						$('#title-group').addClass('has-error'); // add the error class to show red input
						$('#title-group').append('<div class="help-block">' + data.errors.title + '</div>'); // add the actual error message under our input
					}

					// handle errors for firstname ---------------
					if (data.errors.firstname) {
						$('#firstname-field').addClass('has-error'); // add the error class to show red input
						$('#firstname-field').append('<div class="help-block">' + data.errors.firstname + '</div>'); // add the actual error message under our input
					}

					// handle errors for firstname ---------------
					if (data.errors.lastname) {
						$('#lastname-field').addClass('has-error'); // add the error class to show red input
						$('#lastname-field').append('<div class="help-block">' + data.errors.lastname + '</div>'); // add the actual error message under our input
					}

				} else {

					// ALL GOOD! just show the success message!
					$('#newCustomer').append('<div class="alert alert-success" id="mess">' + data.message + '</div>');
					if(data.type == "Anonymous" || data.type == "Organisation"){
						data.title_group = "";
						data.last_name = "";
					}

					$.fn.resetFunction();

					//add last row to the list
					$('#queue').append('<div class="row lista"><div class="col-xs-1 col-sm-1 text-center">' + data.count + '</div><div class="col-xs-3 col-sm-3">' + data.type +
					'</div><div class="col-xs-3 col-sm-3">' + data.title_group + ' ' + data.first_name + ' ' + data.last_name +
					'</div><div class="col-xs-2 col-sm-2">' +	data.services + '</div><div class="col-xs-1 col-sm-2 col-xs-offset-1">' + (data.time_reg).substr(0,5) + '</div></div>');


				}
			})

			// using the fail promise callback
			.fail(function(data) {

				// show any errors
				// best to remove for production
				console.log(data);
			});

		// stop the form from submitting the normal way and refreshing the page
		event.preventDefault();
	});

});
