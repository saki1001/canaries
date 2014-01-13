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
    
    /**
     * Register and enqueue a scripts and styles.
     */
    // function child_add_scripts() {
    //     wp_register_script( 'mailchimp-signup', get_stylesheet_directory_uri() . '/js/mailchimp.js', array('jquery'), NULL, true );
    //     wp_register_script( 'email-form-validate', get_stylesheet_directory_uri() . '/js/jquery.form-n-validate.js', array('jquery'), NULL, true );
    //     
    //     wp_enqueue_script( 'mailchimp-signup' );
    //     wp_enqueue_script( 'email-form-validate' );
    // }
    // 
    // add_action( 'wp_enqueue_scripts', 'child_add_scripts' );
    
    // CATEGORY IN BODY TAG
    // add category nicenames in body and post class
    function category_id_class($classes) {
        global $post;
        
        if( is_page('home') || is_home() ) {
            $classes[] = 'home';
        }
        
        if( is_single() ) {
            
            $catArray = get_the_terms( $post->ID, 'category' );
            $portCatArray = get_the_terms( $post->ID, 'portfolio-category' );
            
            if( $catArray != '' ) {
                
                $classes[] = 'blog';
                
                $category = reset($catArray);
                $categorySlug = $category->slug;
                $parentCategory = get_term($category->parent, 'category');
                $parentCategorySlug = $parentCategory->slug;
                
                if( isset($parentCategorySlug) ) {
                    $classes[] = $parentCategorySlug;
                
                } elseif( isset($categorySlug) ) {
                    $classes[] = $categorySlug;
                
                }
                
            } elseif ( $portCatArray != '' ) {
                
                $classes[] = 'portfolio';
                
                $portCat = reset($portCatArray);
                $portCatSlug = $portCat->slug;
                $parentPortCat = get_term($portCat->parent, 'portfolio-category');
                $parentPortCatSlug = $parentPortCat->slug;
                
                if( isset($parentPortCatSlug) ) {
                    $classes[] = $parentPortCatSlug;
                
                } elseif( isset($portCatSlug) ) {
                    $classes[] = $portCatSlug;
                
                }
            }
            
            return $classes;
        }
        
    }
    add_filter('get_body_class', 'category_id_class');
    
?>