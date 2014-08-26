<?php
/*===================================================================
=            Custom Functions - KDW Highwind Child Theme            =
===================================================================*/

/*==========  Init  ==========*/
function kdw_highwind_init(){
	//remove actions
}

add_action( 'init', 'kdw_highwind_init');


/*==========  Child theme CSS and custom JavaScript  ==========*/
function kdw_highwind_scripts() {

    // Hat-tip: @kovshenin - http://kovshenin.com/2014/child-themes-import/
    wp_enqueue_style( 'highwind-parent', get_template_directory_uri() . '/style.css' );

	wp_enqueue_script( 'kdw-js', get_stylesheet_directory_uri() . '/assets/js/kdw.js', array('jquery'), '1.0.0', true );
}

add_action( 'wp_enqueue_scripts', 'kdw_highwind_scripts' );

/*==========  Add to theme customizer  ==========*/

function kdw_highwind_customizer( $wp_customize ) {

    //sections
    $wp_customize->add_section(
        'social_media_channels',
        array(
            'title' => 'Social Media Channels',
            'description' => 'Enter the full URL to the social media channel landing page',
            'priority' => 35
        )
    );

    $wp_customize->add_section(
        'google_analytics_js',
        array(
            'title' => 'Google Analytics ID',
            'description' => 'Example: UA-######-1',
            'priority' => 36
        )
    );

// settings
    $wp_customize->add_setting(
    'twitter_textbox',
    array(
        'default' => '',
    )
);

    $wp_customize->add_setting(
    'linkedin_textbox',
    array(
        'default' => '',
    )
);

    $wp_customize->add_setting(
    'github_textbox',
    array(
        'default' => '',
    )
);

     $wp_customize->add_setting(
    'youtube_textbox',
    array(
        'default' => '',
    )
);
     $wp_customize->add_setting(
    'pinterest_textbox',
    array(
        'default' => '',
    )
);
     $wp_customize->add_setting(
    'wordpress_textbox',
    array(
        'default' => '',
    )
);

     $wp_customize->add_setting(
    'ga_textbox',
    array(
        'default' => '',
    )
);

//controls
    $wp_customize->add_control(
    'twitter_textbox',
    array(
        'label' => 'Twitter',
        'section' => 'social_media_channels',
        'type' => 'text',
    )
);
    $wp_customize->add_control(
    'linkedin_textbox',
    array(
        'label' => 'LinkedIn',
        'section' => 'social_media_channels',
        'type' => 'text',
    )
);
    $wp_customize->add_control(
    'github_textbox',
    array(
        'label' => 'GitHub',
        'section' => 'social_media_channels',
        'type' => 'text',
    )
);
    $wp_customize->add_control(
    'youtube_textbox',
    array(
        'label' => 'YouTube',
        'section' => 'social_media_channels',
        'type' => 'text',
    )
);
    $wp_customize->add_control(
    'pinterest_textbox',
    array(
        'label' => 'Pinterest',
        'section' => 'social_media_channels',
        'type' => 'text',
    )
);

    $wp_customize->add_control(
    'wordpress_textbox',
    array(
        'label' => 'WordPress',
        'section' => 'social_media_channels',
        'type' => 'text',
    )
);

    $wp_customize->add_control(
    'ga_textbox',
    array(
        'label' => 'ID',
        'section' => 'google_analytics_js',
        'type' => 'text',
    )
);
}
add_action( 'customize_register', 'kdw_highwind_customizer' );

/*==========  Show social media channels  ==========*/

function kdw_highwind_social_media(){

	$active = '';
	$channels = array('twitter', 'linkedin', 'github', 'youtube');

	for($i = 0; $i<sizeof($channels); $i++){

		if( get_theme_mod( $channels[$i] . '_textbox', '' ) != ''){
			$active.= '<li><a href="' . get_theme_mod( $channels[$i] . '_textbox', '' ) . '"><i class="fa fa-2x fa-' . $channels[$i] . '"></i></a></li>' . "\n";
		}
	}

	if(	$active != ''){
		echo "\n" . '<div class="widget sm-channels">' . "\n" . '<ul>';
		echo $active;
		echo '</ul>' . "\n" . "</div>" . "\n";

	}

}

add_action('highwind_sidebar_top', 'kdw_highwind_social_media');

function kdw_highwind_google_analytics_js(){

        if( get_theme_mod( 'ga_textbox', '' ) != '' ){
            $gaId = get_theme_mod( 'ga_textbox', '' );

            $gaSnippet = "
            <script>
                (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

                ga('create', '" . $gaId ."', 'auto');
                ga('send', 'pageview');
            </script>";

            echo $gaSnippet;

        }
}

add_action('highwind_head_bottom', 'kdw_highwind_google_analytics_js');

/*==========  Update footer attribution   ==========*/



/*==========  Add post formats  ==========*/
function kdw_highwind_formats(){
     add_theme_support( 'post-formats', array( 'gallery', 'link', 'image', 'quote', 'video', 'audio') );
}

add_action( 'after_setup_theme', 'kdw_highwind_formats', 11 );


function kdw_highwind_show_format(){

	$format = get_post_format();
	
	switch ($format) {
	    case "gallery":
	        $icon = 'fa-picture-o';
	        break;
	    case "link":
	        $icon = 'fa-link';
	        break;
	    case "image":
	        $icon = 'fa-picture-o';
	        break;
	    case "quote":
	        $icon = 'fa-quote-right';
	        break;
	    case "video":
	        $icon = 'fa-video-camera';
	        break;
	    case "audio":
	        $icon = 'fa-volume-up';
	        break;
	    default:
	    	$icon = 'fa-file-text-o';
	}
	echo '<a class="post-format ' . $format . '" href="/type/' . $format . '"><i class="fa fa-2x ' . $icon . '"></i></a>';
}

add_action('highwind_content_entry_top', 'kdw_highwind_show_format');

?>