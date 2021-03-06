<?php

function bfa_post_kicker($before = '<div class="post-kicker">', $after = '</div>') {
	
	global $bfa_ata;
	
    // don't display on WP Email pages
    if(intval(get_query_var('email')) != 1) {
    	
    	if( (is_home() AND $bfa_ata['post_kicker_home'] != "") OR
    	(is_page() AND $bfa_ata['post_kicker_page'] != "") OR
    	(is_single() AND $bfa_ata['post_kicker_single'] != "") OR
    	( (is_archive() OR is_search() OR is_author() OR is_tag()) AND $bfa_ata['post_kicker_multi'] != "") ) {
    		
			echo $before;
			if ( is_home() ) { 
				echo postinfo($bfa_ata['post_kicker_home']); 
			} 	elseif ( is_page() ) { 
				echo postinfo($bfa_ata['post_kicker_page']); 
			} 	elseif ( is_single() ) { 
				echo postinfo($bfa_ata['post_kicker_single']); 
			} 	else { 
				echo postinfo($bfa_ata['post_kicker_multi']); 
			}
			echo $after;
			
    	}
    	
    }
    
}




function bfa_post_headline($before = '<div class="post-headline">', $after = '</div>') {

	global $bfa_ata, $post;

	if ( is_single() OR is_page() ) {
		$bfa_ata_body_title = get_post_meta($post->ID, 'bfa_ata_body_title', true);
		$bfa_ata_display_body_title = get_post_meta($post->ID, 'bfa_ata_display_body_title', true);
	} else {
		$bfa_ata_body_title_multi = get_post_meta($post->ID, 'bfa_ata_body_title_multi', true);
	}
	
	if ( (!is_single() AND !is_page()) OR $bfa_ata_display_body_title == '' ) {
		
		
		echo $before; ?>
		<h<?php echo $bfa_ata['h_posttitle']; ?>><?php 
			
		if( !is_single() AND !is_page() ) { ?>
			
			<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php 
		} 

		if ( (is_single() OR is_page()) AND $bfa_ata_body_title != "" ) {
			echo htmlentities($bfa_ata_body_title,ENT_QUOTES,'UTF-8');
		} else {
			if ( $bfa_ata_body_title_multi != '' ) echo htmlentities($bfa_ata_body_title_multi,ENT_QUOTES,'UTF-8');  
			else the_title(); 
		}

		if ( !is_single() AND !is_page() ) { ?></a><?php } ?></h<?php echo $bfa_ata['h_posttitle']; ?>>
		<?php echo $after;
	
	}
	
}




function bfa_post_byline($before = '<div class="post-byline">', $after = '</div>') {
	
	global $bfa_ata, $post;
	
    // don't display on WP Email pages
    if(intval(get_query_var('email')) != 1) {
    	
    	if( (is_home() AND $bfa_ata['post_byline_home'] != "") OR
    	(is_page() AND $bfa_ata['post_byline_page'] != "") OR
    	(is_single() AND $bfa_ata['post_byline_single'] != "") OR
    	( (is_archive() OR is_search() OR is_author() OR is_tag()) AND $bfa_ata['post_byline_multi'] != "") ) {
    		
    		echo $before;
    		if ( is_home() ) { 
    			echo postinfo($bfa_ata['post_byline_home']); 
    		} elseif ( is_page() ) { 
    			echo postinfo($bfa_ata['post_byline_page']); 
    		} elseif ( is_single() ) { 
    			echo postinfo($bfa_ata['post_byline_single']); 
    		} 	else { 
    			echo postinfo($bfa_ata['post_byline_multi']); 
    		}
    		echo $after;
    		
    	}
    	
    }
    
}



						
function bfa_post_bodycopy($before = '<div class="post-bodycopy clearfix">', $after = '</div>') {
	
	global $bfa_ata, $post;
	
	echo $before; 
	if ( (is_home() AND $bfa_ata['excerpts_home'] == "Full Posts") OR 
	(is_category() AND $bfa_ata['excerpts_category'] == "Full Posts") OR 
	(is_date() AND $bfa_ata['excerpts_archive'] == "Full Posts") OR 
	(is_tag() AND $bfa_ata['excerpts_tag'] == "Full Posts") OR 
	(is_search() AND $bfa_ata['excerpts_search'] == "Full Posts") OR 
	(is_author() AND $bfa_ata['excerpts_author'] == "Full Posts") OR 
	is_single() OR is_page() OR 
	(is_home() AND !is_paged() AND $bfa_ata['postcount'] <= $bfa_ata['full_posts_homepage']) ) { 
		$bfa_ata_more_tag_final = str_replace("%post-title%", the_title('', '', false), $bfa_ata['more_tag']);
		the_content($bfa_ata_more_tag_final); 
	} else { 
		if (function_exists('the_post_thumbnail') AND !function_exists('tfe_get_image')) the_post_thumbnail();
		the_excerpt(); 
	} 
	echo $after;
	
}



						
function bfa_post_pagination($before = '<p class="post-pagination"><strong>Pages:', $after = '</strong></p>') {
	
	global $bfa_ata;
	
	if ( (is_home() AND $bfa_ata['excerpts_home'] == "Full Posts") OR 
	(is_category() AND $bfa_ata['excerpts_category'] == "Full Posts") OR 
	(is_date() AND $bfa_ata['excerpts_archive'] == "Full Posts") OR 
	(is_tag() AND $bfa_ata['excerpts_tag'] == "Full Posts") OR 
	(is_search() AND $bfa_ata['excerpts_search'] == "Full Posts") OR 
	(is_author() AND $bfa_ata['excerpts_author'] == "Full Posts") OR 
	is_single() OR is_page() ) {
		wp_link_pages('before='.$before.'&after='.$after.'&next_or_number=number'); 
	} 
	
}




function bfa_archives_page($before = '<div class="archives-page">', $after = '</div>') {
	
	global $bfa_ata, $wp_query;
	$current_page_id = $wp_query->get_queried_object_id();
	
	if ( is_page() AND $current_page_id == $bfa_ata['archives_page_id'] ) { 
		
		echo $before;				
		if ( $bfa_ata['archives_date_show'] == "Yes" ) { ?>
			<h3><?php echo $bfa_ata['archives_date_title']; ?></h3>
			<ul>
			<?php wp_get_archives('type=' . $bfa_ata['archives_date_type'] . '&show_post_count=' . 
			($bfa_ata['archives_date_count'] == "Yes" ? '1' : '0') . ($bfa_ata['archives_date_limit'] != "" ? '&limit=' . 
			$bfa_ata['archives_date_limit'] : '')); ?>
			</ul>
		<?php } 						
		if ( $bfa_ata['archives_category_show'] == "Yes" ) { ?>
			<h3><?php echo $bfa_ata['archives_category_title']; ?></h3>
			<ul>
			<?php wp_list_categories('title_li=&orderby=' . $bfa_ata['archives_category_orderby'] . 
			'&order=' . $bfa_ata['archives_category_order'] . 
			'&show_count=' . ($bfa_ata['archives_category_count'] == "Yes" ? '1' : '0') . 
			'&depth=' . $bfa_ata['archives_category_depth'] . 
			($bfa_ata['archives_category_feed'] == "Yes" ? '&feed_image=' . get_bloginfo('template_directory') . 
			'/images/icons/feed.gif' : '')); ?>
			</ul>
		<?php } 
		echo $after;
		
	}
	
}




function bfa_post_footer($before = '<div class="post-footer">', $after = '</div>') {
	
	global $bfa_ata;
	
    // don't display on WP Email pages
    if(intval(get_query_var('email')) != 1) {
    	
    	if( (is_home() AND $bfa_ata['post_footer_home'] != "") OR
    	(is_page() AND $bfa_ata['post_footer_page'] != "") OR
    	(is_single() AND $bfa_ata['post_footer_single'] != "") OR
    	( (is_archive() OR is_search() OR is_author() OR is_tag()) AND $bfa_ata['post_footer_multi'] != "") ) {
    		
    		echo $before;
    		if ( is_home() ) { 
    			echo postinfo($bfa_ata['post_footer_home']); 
    		} elseif ( is_page() ) { 
    			echo postinfo($bfa_ata['post_footer_page']); 
    		} elseif ( is_single() ) { 
    			echo postinfo($bfa_ata['post_footer_single']); 
    		} 	else { 
    			echo postinfo($bfa_ata['post_footer_multi']); 
    		}
    		echo $after;
    		
    	}
    	
    }
    
}




function bfa_get_comments() {
	
	global $bfa_ata;
    
	// Load Comments template (on single post pages, and "Page" pages, if set on options page)
	if ( is_single() OR ( is_page() AND $bfa_ata['comments_on_pages'] == "Yes") ) {
		
		// don't display on WP-Email pages
		if( intval(get_query_var('email')) != 1 ) {
			
			if ( function_exists('paged_comments') ) {
				// If plugin "Paged Comments" is activated, for WP 2.6 and older
				paged_comments_template(); 
			} else {
				// This will load either legacy comments template (for WP 2.6 and older) or the new standard comments template (for WP 2.7 and newer)
				comments_template(); 
			}
		
		}
	
	}
    
}


?>