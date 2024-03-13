	<footer class="site-footer section">
		<div class="container">
			<div class="footer-part-wrap">
				<div class="footer-part">
					<?php dynamic_sidebar('footer-1'); ?>
				</div>
				<div class="footer-part">
					<?php dynamic_sidebar('footer-2'); ?>
				</div>
				<div class="footer-part">
					<?php dynamic_sidebar('footer-3'); ?>
				</div>
				<div class="footer-part">
					<?php dynamic_sidebar('footer-4'); ?>
				</div>
			</div>
			<div class="footer-copyright">&copy; <?php echo get_option('ownder', 'Stämpfli Kommunikation'); ?> <?php echo date('Y'); ?></div>
		</div>
	</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>
