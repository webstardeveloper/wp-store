<?php
	$categories_menu_toggle_text = astore_option('categories_menu_toggle_text');
?>
	<div class="cactus-cate-menu-wrap">
		<div class="cactus-cate-menu-toggle"><i class="fa fa-list-ul"></i> 
		<?php echo esc_attr($categories_menu_toggle_text);?>
		</div>
		<?php
			global $post;

			$postid = isset($post->ID)?$post->ID:0;
			if(is_home()){
				$postid = get_option( 'page_for_posts' );
			}

			$expand_menu = get_post_meta($postid , 'astore_expand_menu', true);
			
			
			$expand_menu = apply_filters( 'astore_expand_menu', $expand_menu );

			$menu_class = 'cactus-cate-menu';
			if ( $expand_menu == '1' || $expand_menu == 'on' )
				$menu_class .= ' show';

		?>
		<div class="<?php echo $menu_class;?>" style="display:none;">
			<ul id="browse-categories" class="cactus-cate-nav">
				<li id="menu-item-0" class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-0"><a href="/shop/"><span>All Categories</span></a></li>
				<?php
					$categories = get_terms('product_cat',array('parent' => 0));
					foreach($categories as $cat){
						$sub_cats = get_terms('product_cat',array('child_of' => $cat->term_taxonomy_id));
						$sub_cats_html = '<ul class="sub-menu">';
						foreach($sub_cats as $sub_cat){
							$sub_cats_html = $sub_cats_html.'<li id="menu-item-'.$sub_cat->term_taxonomy_id.'  
                                                        	class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-'.$sub_cat->term_taxonomy_id.'">
                                                        	<a href="/?product_cat='.$sub_cat->slug.'/"> 
                                                                	<span>'.$sub_cat->name.'</span>
                                                        	</a>
							</li>';
						}
						$sub_cats_html = $sub_cats_html.'</ul>';
						echo '<li id="menu-item-'.$cat->term_taxonomy_id.'  
							class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-'.$cat->term_taxonomy_id.'"> 
							<a href="/?product_cat='.$cat->slug.'/"> 
								<span>'.$cat->name.'</span>
							</a>'.$sub_cats_html.'</li>';
					}
				?>
				
			</ul>
		</div>
	</div>
