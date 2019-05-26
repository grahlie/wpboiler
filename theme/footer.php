<?php
/**
 * Footer page
 *  PHP version 7
 *
 * @category Grahlie_WPBoiler
 * @package  Grahlie_WPBoiler
 * @author   Mathias Grahl <mathias@grahlie.se>
 * @license  GPL-2.0+ https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html
 * @link     http://grahlie.se
 */

?>
</div>

<footer id="pageFooter" class="site-footer" role="contentinfo">
	<div class="footer-content row">
		<div class="size8">
			<?php dynamic_sidebar( 'footer' ); ?>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>

<?php echo grahlie_use_analytics(); ?>

</body>
</html>
