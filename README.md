# php-paginator
A pagination class for php. 

## Usage

You can instantiate this class and use its properties and methods to display pagination on a webpage.  It does not handle the html or the css, but it provides methods and properties that you can call and loop over, and it handles the 'page' and 'per_page' GET parameters so that you don't have to mess around with url query strings.

You can instantiate the class like this:

    <?php
		require_once('paginator.php');
		$paginator = new Paginator(array(
			"number_of_objects" => $number_of_objects, 
			"current_page_number" => (array_key_exists('page', $_GET) ? $_GET['page'] : 1),
			"per_page" => (array_key_exists('per_page', $_GET) ? $_GET['per_page'] : 8),
		));
	?>

The 'number_of_objects' parameter is required.  The rest are optional.  After it is instantiated, you can call:

	$paginator->previous()  		# Returns a page dictionary.
	$paginator->next()  			# Returns a page dictionary.
	$paginator->first()  			# Returns a page dictionary.
	$paginator->last()  			# Returns a page dictionary.
	$paginator->pages  			# list of page dictionaries.
	$paginator->current_page_number  	# integer
	$paginator->per_page  			# integer
	$paginator->number_of_objects  		# integer
	$paginator->number_of_pages  		# integer
	$paginator->last_page_number  		# integer
	
Page dictionaries contain the page url, number, and a boolean field denoting whether or not it is the current page.

	$page['url']  				# string
	$page['number']  			# integer
	$page['current']  			# boolean
	
See the example folder for further details.
