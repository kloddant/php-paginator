<?php

	class Paginator {

		private $path;
		private $query_params = array();
		public $current_page_number;
		public $per_page;
		public $number_of_objects;
		public $number_of_pages;
		public $last_page_number;
		private $last_page_index;
		public $pages = array();

		function __construct($kwargs) {
			assert(array_key_exists('number_of_objects', $kwargs));

			$this->path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
			$this->query_params = $_GET;
			$this->current_page_number = $this->dict_get($this->query_params, 'page', $this->dict_get($kwargs, 'current_page_number', 1));
			$this->per_page = $this->dict_get($this->query_params, 'per_page', $this->dict_get($kwargs, 'per_page', 4));
			$this->number_of_objects = $this->dict_get($kwargs, 'number_of_objects');

			$this->number_of_pages = ceil($this->number_of_objects/$this->per_page);
			$this->last_page_number = $this->number_of_pages;
			$this->last_page_index = $this->last_page_number - 1;

			if ($this->current_page_number > $this->last_page_number) {
				http_response_code(404);
				exit;
			}

			for ($i = 1; $i <= $this->number_of_pages; $i++) {
				array_push($this->pages, array(
					"url" => $this->url($i),
					"number" => $i,
					"current" => ($i == $this->current_page_number),
				));
			}

		}

		private function dict_get($dict, $key, $default=null) {
			return (array_key_exists($key, $dict) ? $dict[$key] : $default);
		}

		private function url($i) {
			$query_params = $this->query_params;
			if ($i == 1 && array_key_exists('page', $query_params)) {
				unset($query_params['page']);
			}
			else {
				$query_params['page'] = $i;
			}
			$querystring = http_build_query($query_params);
			$url = ($this->path).($querystring ? "?".$querystring : '');
			return $url;
		}

		public function previous() {
			$previous_page_number = $this->current_page_number - 1;
			$previous_page_index = $previous_page_number - 1;
			$previous_page_index = max($previous_page_index, 0);
			return $this->pages[$previous_page_index];
		}

		public function next() {
			$next_page_number = $this->current_page_number + 1;
	    	$next_page_index = $next_page_number - 1;
	    	$next_page_index = min($next_page_index, $this->last_page_index);
			return $this->pages[$next_page_index];
		}

		public function first() {
			return $this->pages[0];
		}

		public function last() {
			return $this->pages[$last_page_index];
		}

	}

?>
