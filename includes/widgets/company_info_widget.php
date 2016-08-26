<?php
/*
  widget that display company information on footer
 */

class Company_Info_Widget extends WP_Widget {

    //Initialize the widget

    public function __construct() {
        parent::__construct(
                'company_info_widget', 'Advertisement', array('description' => __('Display Advertisements in Plot Listings', 'GoodEarth'))
        );
    }

    /* wps_panel_include_js() */

    // Output Widget in the Back-end
    public function form($instance) {
        $defaults = array(
            'title' => __('Advertisement', 'serene'),
			'icon_code' => 'icon-home-5',
            'company_logo' => 'Select Your Advertisement Image',
            'company_info' => 'Advertisement Content goes Here'
        );

        $instance = wp_parse_args((array) $instance, $defaults);
        ?>
        <!--title-->
        <p>
            <label for="<?php echo $this->get_field_name('title'); ?>"><?php _e('Advertisement Title', 'GoodEarth'); ?></label>
            <input type="text" id="<?php echo $this->get_field_name('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" class="widefat" value="<?php echo esc_attr($instance['title']); ?>" />

        </p>
        <!--icon code-->
        <p>
            <label for="<?php echo $this->get_field_name('icon_code'); ?>"><?php _e('Link to Advertisement', 'serene'); ?></label>
            <input type="text" id="<?php echo $this->get_field_name('icon_code'); ?>" name="<?php echo $this->get_field_name('icon_code'); ?>" class="widefat" value="<?php echo esc_attr($instance['icon_code']); ?>" />

        </p>                
        <!--image-->
        <p>
            <label for="<?php echo $this->get_field_name('company_logo'); ?>"><?php _e('Advertisement Image', 'GoodEarth'); ?></label>
            <input type="text" id="<?php echo $this->get_field_name('company_logo'); ?>" name="<?php echo $this->get_field_name('company_logo'); ?>" class="upload_image widefat" value="<?php echo esc_attr($instance['company_logo']); ?>" />
            <button class="upload_image_button">Upload Image</button>

        </p>
        <!--Description-->
        <p>
            <label for="<?php echo $this->get_field_name('company_info'); ?>"><?php _e('Advertisement Description (if any)', 'GoodEarth'); ?></label>
            <input type="text" id="<?php echo $this->get_field_name('company_info'); ?>" name="<?php echo $this->get_field_name('company_info'); ?>" class="widefat" value="<?php echo esc_attr($instance['company_info']); ?>" />

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

        //logo
        $instance['company_logo'] = strip_tags($new_instance['company_logo']);

        //info
        $instance['company_info'] = strip_tags($new_instance['company_info']);

        return $instance;
    }

    //Displays the Widget on the Front End
    public function widget($args, $instance) {
        extract($args);

        $title = apply_filters('widget-title', $instance['title']);

        $icon_code = $instance['icon_code'];
        $company_logo = $instance['company_logo'];
        $company_info = $instance['company_info'];

        echo $before_widget;
        //$icon = '<i class="' . $icon_code . '"></i>';
        if ($title) {
            echo $before_title . $title . $after_title;
        }
        ?>
        <a href="<?php echo $icon_code; ?>"><img src="<?php echo $company_logo; ?>" /></a>
        <div class="ad-info">
            <p><?php echo $company_info; ?></p>
        </div>
        <?php
        echo $after_widget;
    }

}

register_widget('Company_Info_Widget');
?>