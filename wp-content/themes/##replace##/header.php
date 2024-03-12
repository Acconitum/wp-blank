<?php

use Staempfli\Theme;

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package test
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">

	<nav id="site-navigation" class="main-navigation container">
		<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', Theme::TEXT_DOMAIN ); ?></button>
		<?php
			wp_nav_menu([
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				]
			);
		?>
	</nav>

	<header id="masthead" class="site-header section">
		<div class="container">
			<h1><?php the_title(); ?></h1>
		</div>
	</header>
