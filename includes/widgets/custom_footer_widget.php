<?php
/*
  widget that display company information on footer
 */

class Custom_Footer_Widget extends WP_Widget {

    //Initialize the widget

    public function __construct() {
        parent::__construct(
                'custom_footer_widget', 'Home Page Menu Item', array('description' => __('Display Custom Box on Footer', 'goodearth'))
        );
    }

    /* wps_panel_include_js() */

    // Output Widget in the Back-end
    public function form($instance) {
        $defaults = array(
            'title' => __('Enter Desired Title', 'goodearth'),
            'icon_code' => 'icon-home-5',
            'link_location' => 'http://goodearthproperties.in'
        );

        $instance = wp_parse_args((array) $instance, $defaults);
        ?>
        <!--title-->
        <p>
            <label for="<?php echo $this->get_field_name('title'); ?>"><?php _e('Title', 'a2zdental'); ?></label>
            <input type="text" id="<?php echo $this->get_field_name('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" class="widefat" value="<?php echo esc_attr($instance['title']); ?>" />

        </p>
        <!--icon code-->
        <p>
            <label for="<?php echo $this->get_field_name('icon_code'); ?>"><?php _e('Icon Code', 'a2zdental'); ?></label>
            <input type="text" id="<?php echo $this->get_field_name('icon_code'); ?>" name="<?php echo $this->get_field_name('icon_code'); ?>" class="widefat" value="<?php echo esc_attr($instance['icon_code']); ?>" />

        </p>                

        <!--Link Location-->
        <p>
            <label for="<?php echo $this->get_field_name('link_location'); ?>"><?php _e('Link Location', 'a2zdental'); ?></label>
            <input type="text" id="<?php echo $this->get_field_name('link_location'); ?>" name="<?php echo $this->get_field_name('link_location'); ?>" class="widefat" value="<?php echo esc_attr($instance['link_location']); ?>" />

        </p>

        <?php
    }

    //Process widget function for saving
    public function update($new_instance, $old_instance) {
        $instance = $old_instance;

        //title
        $instance['title'] = strip_tags($new_instance['title']);

        //icon code
        $instance['icon_code'] = strip_tags($new_instance['icon_code']);


        //link location
        $instance['link_location'] = strip_tags($new_instance['link_location']);

        return $instance;
    }

    //Displays the Widget on the Front End
    public function widget($args, $instance) {
        extract($args);

        $title = apply_filters('widget-title', $instance['title']);

        $icon_code = $instance['icon_code'];
        $link_location = $instance['link_location'];

        echo $before_widget;
        $icon = '<i class="' . $icon_code . '"></i>';
		$link = "<span><a href='".$link_location."'>".$title."</a></span>";
        if ($title) {
			
            echo $icon.$link;
        }
        
        echo $after_widget;
    }

}

register_widget('Custom_Footer_Widget');
?>