<?php
    
    // DEBUGGING
    if(!function_exists('_log')){
        function _log( $message ) {
            if( WP_DEBUG === true ){
                if( is_array( $message ) || is_object( $message ) ){
                    error_log( print_r( $message, true ) );
                } else {
                    error_log( $message );
                }
            }
        }
    }
    
    // CATEGORY IN BODY TAG
    // add category nicenames in body and post class
    function category_id_class($classes) {
        global $post;
        
        if( is_single() ) {
            $catArray = get_the_terms( $post->ID, 'portfolio-category' );
            $category = reset($catArray);
            $categorySlug = $category->slug;
            $parentCat = get_term($category->parent, 'portfolio-category');
            $parentCatSlug = $parentCat->slug;
            
            if( isset($parentCatSlug) ) {
                $classes[] = $parentCatSlug;
                
            } elseif( isset($categorySlug) ) {
                $classes[] = $categorySlug;
                
            } else {
                // do nothing
            }
            
            return $classes;
        }
    }
    add_filter('body_class', 'category_id_class');
    
?>