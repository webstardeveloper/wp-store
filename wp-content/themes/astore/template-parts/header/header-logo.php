<?php
if ( get_theme_mod( 'custom_logo' ) ) {
			$logo = wp_get_attachment_image_src( get_theme_mod( 'custom_logo' ), 'full' );
			$logo = '<a href="'.esc_url( home_url( '/' ) ).'"><img src="' . esc_url( $logo[0] ) . '"></a>';
			echo $logo;
		}else{
?>
<?php
	$header_text_color = get_header_textcolor();

?>
                    
<?php if ( 'blank' != $header_text_color ) :?>

  <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
  <h2 class="site-name">
    <?php bloginfo( 'name' ); ?>
  </h2>
  </a>
   <span class="site-tagline"><?php bloginfo('description'); ?></span>
<?php endif;?>

<?php	
		}		
?>

