<div class="footer-widget-area">
<?php
	$display_footer_widgets = astore_option('display_footer_widgets');
	if( $display_footer_widgets == '1'  || is_customize_preview() ):
		$css_class = 'row';
		if( $display_footer_widgets !=1 && is_customize_preview() )
			$css_class  .= ' hide';
?>
      <div class="<?php echo $css_class; ?>">
      <?php for ($i = 1; $i <= 4; $i++) : ?>
      <?php if (is_active_sidebar("footer-".$i)) : ?>
		<div class="col-md-3 col-sm-6">
        <?php dynamic_sidebar("footer-".$i); ?>
        </div>
        <?php endif; ?>
        <?php endfor; ?>
      </div>
      <?php endif; ?>
    </div>
     