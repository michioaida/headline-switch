    <div>
        <h2>Headline Pane Options</h2>
        
        <?php 
            //START Notification of Option Saved
            if ( $_REQUEST['settings-updated'] == "true") { 
        ?>
            <div id="update-status">
                <p><strong>Options Saved</strong></p>
            </div>
        <?php } //END Notification of Option Saved ?>
        
        
        <?php settings_fields( 'headline_option' ); ?>
        <?php $options = get_option( 'headline_setting' ); 
                if (isset($options[headlineoption]) {
        ?>
                <script type="text/javascript">
                    jQuery(document).ready(function($){
                        $("#<?php echo $options[headlineoption]; ?> ").show();
                    }
                </script>
        <?php
                }
        ?>
        <?php print_r($options); ?>
        <?php 
        
        <?php echo "hey"; ?>

        <div class="headline-selection-container">
            <a href="headline_plugin-1"><div style="padding-bottom: 14px;"><img src="<?php echo plugins_url( '../assets/images/headline-1.png' , __FILE__ ) ?>"></a>
        </div>

        <div class="headline-selection-container">
            <input class="headline-radio" id="headline-radio-one" type="radio" name="headline_setting[headlineoption]" value="headline-one" <?php checked( $options['headlineoption'], "headline-one" ); ?>>Headline - One Post<br>
            <div style="padding-bottom: 14px;"><img src="<?php echo plugins_url( '../assets/images/headline-1.png' , __FILE__ ) ?>"></div>
        </div>
        
        <div class="headline-selection-container">
            <input class="headline-radio" id="headline-radio-two" type="radio" name="headline_option_settings[headlineoption]" value="headline-two" <?php checked( $options['headlineoption'], "headline-two" ); ?>>Headline - Two Posts<br>
            <div style="padding-bottom: 14px;"><img src="<?php echo plugins_url( '../assets/images/headline-2.png' , __FILE__ ) ?>"></div>
        </div>
        
        <div class="headline-selection-container">
            <input class="headline-radio" type="radio" id="headline-radio-two"name="headline_option_settings[headlineoption]" value="headline-two" <?php checked( $options['headlineoption'], "headline-three" ); ?>>Headline - Three Posts<br>

            <div>
                <img src="<?php echo plugins_url( '../assets/images/headline-3.png' , __FILE__ ) ?>">
            </div>
        </div>
        <div class="clear-div"></div>
        
        <form method="post" action="options.php">
            <?php @settings_fields('headline_setting_group'); ?>
            <?php @do_settings_fields('headline_setting_group'); ?>       
            <?php
            
                $postchoices = get_option( 'headline_option_settings' );
			
                $postchoiceA = $postchoices['postchoiceA'];
                $mobilechoice = $postchoices['mobilechoice']; 
            ?>
            <?php 
                $headlineSelection = $options['headlineoption']; 
                $args = array(
                            'posts_per_page'   => 40,
                            'order'            => 'DESC',
                            'orderby' => 'date',
                            'taxonomy' => 'article_type',
                            'post_type' => 'post',
                            'post_status' => 'publish',
                        );
                $custom_posts = get_posts($args);
                foreach ($custom_posts as $post) : setup_postdata($post);        
                    $get_id = $post->ID;
                    $get_title = $post->post_title;
                    $option_all .= '<option value="'. $get_id .'"' . $selected . '>' . $get_title . '</option>';
                endforeach;
            ?>
                <div id="headline-radio-one-settings" class="headline-settings">
                    <h2>Main Story</h2>
                    Current Post: 
                    <select name="headline_setting[postchoiceOne]">
                        <?php echo $option_all; ?>
                    </select>
                    <br>
                    Mobile Post: 
                    <select name="headline_setting[mobilechoiceOne]">
                        <?php echo $option_all; ?>
                    </select>
                </div>
            <p><?php submit_button(); ?></p>
            <div id="pane-selection">
            </div>
        </form>
    </div>
    <div id="outside">
    </div>
