<?php

use Staempfli\Theme;

get_header(); 

?>

	<main id="primary" class="site-main">
		<?php
			while ( have_posts() ) :
				the_post();
				Theme::includeTemplate('content'); 
			endwhile;
		?>
	</main>
<?php
get_sidebar();
get_footer();
