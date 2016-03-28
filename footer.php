<?php
/**
 * Footer page
 * @package grahlie
 */

?>
</div>

<footer id="pageFooter" class="site-footer" role="contentinfo">
	<div class="footer-content">
        <p class="grahlieLogo">
            &copy; <?php bloginfo( 'name' ); ?> -
            <?php printf( esc_html__( 'Developed by %1$s', 'grahlie' ), '<a href="http://grahlie.se" rel="designer"><img src="' . get_template_directory_uri() . '/images/grahlie.svg" alt="grahlie" /></a>'); ?>
        </p>
    </div>
</footer>

<?php wp_footer(); ?>

<?php echo grahlie_use_analytics(); ?>

</body>
</html>
