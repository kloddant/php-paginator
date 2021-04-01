<?php
	wp_enqueue_style('pagination', get_stylesheet_directory_uri() . '/assets/css/pagination.css', array());
	$previous = $paginator->previous();
	$next = $paginator->next();
?>
<?php if ($paginator->number_of_pages > 1) { ?>
	<nav class="pagination" role="navigation" aria-label="Pagination">
		<a href="<?php echo $previous['url']; ?>" class="previous <?php echo ($previous['current'] ? 'disabled' : ''); ?>" rel="prev" aria-label="Previous Page (<?php echo $previous['number']; ?>)">
			&#9664;
		</a>
		<?php foreach ($paginator->pages as $page) { ?>
			<a href="<?php echo $page['url']; ?>" class="page <?php echo ($page['current'] ? 'current' : ''); ?>" aria-label="Page <?php echo $page['number']; ?>" title="Page <?php echo $page['number']; ?>">
				<?php echo $page['number']; ?>
			</a>
		<?php } ?>
		<a href="<?php echo $next['url']; ?>" class="next <?php echo ($next['current'] ? 'disabled' : ''); ?>" rel="next" aria-label="Next Page (Page <?php echo $previous['number']; ?>)" title="Next Page (<?php echo $previous['number']; ?>)">
			&#9654;
		</a>
	</nav>
<?php } ?>
