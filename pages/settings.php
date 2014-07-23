<div>
    <h2>Headline Pane Options</h2>  
    <?php 
        // Notification of Option Saved
        if ( $_REQUEST['settings-updated'] == "true") { 
    ?>
        <div id="update-status">
            <p><strong>Options Saved</strong></p>
        </div>
    <?php } ?>

    <?php
            /**
             * Get all options and put them in $options. If $options has the headlineoption 
             * show which image is selected and find the choices set option to SELECTED 
             */
            $options = get_option( 'headline_setting' ); 
            if (isset($options[headlineoption])) {
    ?>
            <script type="text/javascript">
                jQuery(document).ready(function($){
                    $("#<?php echo $options[headlineoption]; ?>-settings").show();
                    $("#<?php echo $options[headlineoption]; ?>").css("border", "4px solid red");
                    <?php 
                        /* Count number of $options array and deduct one
                        *  We don't need the last array since we are only 
                        *  which posts the user chose. 
                        */
                        $option_arr_num = count($options) - 1;
                        
                        for($i = 1; $i <= $option_arr_num; $i++) {
                            $array_val = "postchoice" .  $i;
                            $post_id_val = $options[$array_val];
                   ?>
                            $('#<?php echo $options[headlineoption]; ?>-settings #<?php echo $array_val; ?> option[value="<?php echo $post_id_val; ?>"]').attr("selected", true);
                    <?php        
                        }
                    ?>
                });
            </script>
    <?php
            }
    ?>
    <?php             
        /**
         * Get 10 most recent posts and populate the option lists
         */ 
        $args = array(
                    'posts_per_page'    => 10,
                    'order'             => 'DESC',
                    'orderby'           => 'date',
                    'taxonomy'          => 'article_type',
                    'post_type'         => 'post',
                    'post_status'       => 'publish',
                );
        $custom_posts = get_posts($args);
        foreach ($custom_posts as $post) : setup_postdata($post);        
            $get_id = $post->ID;
            $get_title = $post->post_title;
            $option_all .= '<option value="'. $get_id .'"' . $selected . '>' . $get_title . '</option>' . "\r\n";
        endforeach;
    ?>

    <!-- Display all 3 choices -->
    <div class="headline-selection-container">
        <div class="headline-radio" id="headline-radio-one"><img src="<?php echo plugins_url( '../assets/images/headline-1.png' , __FILE__ ) ?>"></div>
    </div>
    
    <div class="headline-selection-container">
        <div class="headline-radio" id="headline-radio-two"><img src="<?php echo plugins_url( '../assets/images/headline-2.png' , __FILE__ ) ?>"></div>
    </div>
    
    <div class="headline-selection-container">
        <div class="headline-radio" id="headline-radio-three"><img src="<?php echo plugins_url( '../assets/images/headline-3.png' , __FILE__ ) ?>"></div>
    </div>
    <div class="clear-div"></div>
    
    <!-- Group settings for Headline Choice One -->
    <div id="headline-radio-one-settings" class="headline-settings">
        <form method="post" action="options.php">
            <?php   
                    @settings_fields('headline_setting_group-1');
                    @do_settings_fields('headline_setting_group-1'); 
            ?>       
                <div class="pane-choice-container">
                    <label>Pane Post:</label>
                    <select id="postchoice1" name="headline_setting[postchoice1]">
                        <?php echo $option_all; ?>
                    </select>
                </div>
                <input type="hidden" name="headline_setting[headlineoption]" value="headline-radio-one">
            <p><?php submit_button(); ?></p>
        </form>
    </div>
    
    <!-- Group settings for Headline Choice Two -->
    <div id="headline-radio-two-settings" class="headline-settings">
        <form method="post" action="options.php">
            <?php   
                    @settings_fields('headline_setting_group-2');
                    @do_settings_fields('headline_setting_group-2'); 
            ?>        
                <div class="pane-choice-container">
                    <label>Pane Post 1:</label>
                    <select id="postchoice1" name="headline_setting[postchoice1]">
                        <?php echo $option_all; ?>
                    </select>
                </div>
                <div class="pane-choice-container">
                    <label>Pane Post 2:</label>
                    <select id="postchoice2" name="headline_setting[postchoice2]">
                        <?php echo $option_all; ?>
                    </select>
                </div>
                <input type="hidden" name="headline_setting[headlineoption]" value="headline-radio-two">
            <p><?php submit_button(); ?></p>
        </form>
    </div>
    
    <!-- Group settings for Headline Choice Three -->
    <div id="headline-radio-three-settings" class="headline-settings">
        <form method="post" action="options.php">
            <?php   
                    @settings_fields('headline_setting_group-3');
                    @do_settings_fields('headline_setting_group-3'); 
            ?>   
                <div class="pane-choice-container">      
                    <label>Pane Post 1:</label>
                    <select id="postchoice1" name="headline_setting[postchoice1]">
                        <?php echo $option_all; ?>
                    </select>
                </div>
                <div class="pane-choice-container">
                    <label>Pane Post 2:</label>
                    <select id="postchoice2" name="headline_setting[postchoice2]">
                        <?php echo $option_all; ?>
                    </select>
                </div>
                <div class="pane-choice-container">
                    <label>Pane Post 3:</label>
                    <select id="postchoice3" name="headline_setting[postchoice3]">
                        <?php echo $option_all; ?>
                    </select>
                </div>
                <input type="hidden" name="headline_setting[headlineoption]" value="headline-radio-three">
            <p><?php submit_button(); ?></p>
        </form>
    </div>
</div>
