# php-paginator
A pagination class for php. 

# Usage

You can instantiate the class like this:

    <?php
	
		if (!function_exists('dict_get')) {
			function dict_get($dict, $key, $default=null) {
				return (array_key_exists($key, $dict) ? $dict[$key] : $default);
			}
		}
		
		$category = get_queried_object();

		$current_page_number = dict_get($_GET, 'page', 1);
		$per_page = dict_get($_GET, 'per_page', 8);
		$offset = ($current_page_number-1)*$per_page;

		require_once('paginator.php');
		$paginator = new Paginator(array(
			"number_of_objects" => $category->count, 
			"current_page_number" => $current_page_number,
			"per_page" => $per_page,
		));
	?>

The 'number_of_objects' parameter is required.  The rest are optional.  After it is initiated, you can call:

	$paginator->previous()  		# Returns a page dictionary.
	$paginator->next()  			# Returns a page dictionary.
	$paginator->first()  			# Returns a page dictionary.
	$paginator->last()  			# Returns a page dictionary.
	$paginator->pages  			# Returns a list of page dictionaries.
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
