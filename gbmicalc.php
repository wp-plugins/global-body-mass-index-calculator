<?php
ob_start();
/*
  Plugin Name: Global Body Mass Index Calculator
  Plugin URI: http://www.ostheimer.at/global-body-mass-index-calculator-wordpress-plugin/
  Description: A Global Body Mass Index Calculator Widget. If you need insert in article please use short tag [gbmicalc]
  Version: 1.0.5.0
  Author: helpstring
  Author URI: http://www.ostheimer.at/
 */

register_activation_hook(__FILE__, array('GBMI_Calc_Widget', 'activate'));
register_deactivation_hook(__FILE__, array('GBMI_Calc_Widget', 'deactivate'));

add_action('init', 'add_gbmi_javascript');
define('MY_TEXTDOMAIN', 'GBMI-calc');
load_plugin_textdomain(MY_TEXTDOMAIN, WP_PLUGIN_URL . '/global-body-mass-index-calculator/languages', 'gbmicalc/languages');

function add_gbmi_javascript() {
    if (is_admin()) {
        wp_enqueue_script('calc-colorpicker', WP_PLUGIN_URL . '/global-body-mass-index-calculator/js/plugins/colorpicker/colorpicker.js', array('jquery'));
        wp_enqueue_style('colorpicker-styles', WP_PLUGIN_URL . '/global-body-mass-index-calculator/js/plugins/colorpicker/css/colorpicker.css');
        wp_enqueue_style('backend-styles', WP_PLUGIN_URL . '/global-body-mass-index-calculator/css/backend.css');
    } else {
		wp_deregister_script( 'jquery' ); // deregistering any jquery script
		wp_register_script( 'jquery', WP_PLUGIN_URL . '/global-body-mass-index-calculator/js/jquery.min.js');// registering jquery again
        wp_enqueue_script('jquery');

        wp_enqueue_style('front-styles', WP_PLUGIN_URL . '/global-body-mass-index-calculator/css/front.css');
    }
}

class GBMI_Calc_Widget {

    function activate() {
        $data = array('title' => 'Global Body Mass Index Calculator', 'standard' => 'standard', 'allowLink' => '');
        if (!get_option('GBMI_Calc_Widget')) {
            add_option('GBMI_Calc_Widget', $data);
        } else {
            update_option('GBMI_Calc_Widget', $data);
        }
    }

    function deactivate() {
        delete_option('GBMI_Calc_Widget');
    }

    function control() {
        $data = get_option('GBMI_Calc_Widget');
        ?>

        <p><label>Title<input name="title" type="text" value="<?php echo $data['title']; ?>"/></label></p>

        <p><label>Calculator Mode
                <select name="standard">
                    <option <?php echo $data['standard'] == "standard" ? "selected" : " " ?> value="standard">Standard</option>
                    <option <?php echo $data['standard'] == "metric" ? "selected" : " " ?> value="metric"> Metric</option>
                </select>
            </label></p>

        <p><label>Params<br/>
                Height: <input type="text" name="height" type="text"
                               value="<?php echo $data['height'] ? $data['height'] : "auto" ?>"/>
                Width: <input type="text" name="width" type="text"
                              value="<?php echo $data['width'] ? $data['width'] : "300" ?>"/>
            </label>

        </p>
        <div class="colorHolder">
            <div class="colorSelector" id="bgColorSelector">
                <div id="widgetBackground" style="background-color: <?php echo $data['bgcolor']; ?>"></div>
            </div>
            <span>Widget Start Background Color</span></div>

        <div class="colorHolder">
            <div class="colorSelector" id="bgEndColorSelector">
                <div id="widgetEndBackground" style="background-color: <?php echo $data['bgendcolor']; ?>"></div>
            </div>
            <span>Widget End Background Color</span></div>

        <div class="colorHolder">
            <div class="colorSelector" id="textColorSelector">
                <div id="widgetText" style="background-color: <?php echo $data['textcolor']; ?>"></div>
            </div>

            <span>Widget Text Color</span></div>

        <input name="bgcolor" type="hidden" value="<?php echo $data['bgcolor']; ?>"/></label>
        <input name="bgendcolor" type="hidden" value="<?php echo $data['bgendcolor']; ?>"/>
        <input name="textcolor" type="hidden" value="<?php echo $data['textcolor']; ?>"/>

        <div id="bmiCalcDemo" 
             style="color: <?php echo $data['textcolor']; ?>; 
             border: 1px solid rgba(21, 11, 11, 0.199219); padding: 5px; width: 200px; 
             -moz-border-radius: 12px; -webkit-border-radius: 12px; border-radius: 12px; -moz-box-shadow: 0px 0px 4px #ffffff; 
             -webkit-box-shadow: 0px 0px 4px #ffffff; box-shadow: 0px 0px 4px #ffffff; background-color: <?php echo $data['bgcolor']; ?>; 
             background-image: -moz-linear-gradient(top, <?php echo $data['bgcolor']; ?>, <?php echo $data['bgendcolor']; ?>); 
             background-image: -webkit-gradient(linear,left top,left bottom,color-stop(0, <?php echo $data['bgcolor']; ?>),color-stop(1, <?php echo $data['bgendcolor']; ?>)); 
             filter:  progid:DXImageTransform.Microsoft.gradient(startColorStr='<?php echo $data['bgcolor']; ?>', EndColorStr='<?php echo $data['bgendcolor']; ?>'); -ms-filter: \"
             progid:DXImageTransform.Microsoft.gradient(startColorStr='<?php echo $data['bgcolor']; ?>', EndColorStr='<?php echo $data['bgendcolor']; ?>')\";">
            Widget Color Preview
        </div>
        <p><label>Allow link back to www.gesundesabnehmen.at&nbsp;&nbsp;<input name="allowLink" type="checkbox"
                                                                   value="yes" <?php echo $data['allowLink'] == 'yes' ? "checked" : "" ?>/></label>
        </p>

        <script src="<?php echo WP_PLUGIN_URL . '/global-body-mass-index-calculator/js/calcs.js'; ?>"></script>

        <?php
        if (isset($_POST['title'])) { 
            $data['title'] = attribute_escape($_POST['title']);
            $data['standard'] = attribute_escape($_POST['standard']);
            $data['height'] = attribute_escape($_POST['height']);
            $data['width'] = attribute_escape($_POST['width']);
            $data['bgcolor'] = attribute_escape($_POST['bgcolor']);
            $data['bgendcolor'] = attribute_escape($_POST['bgendcolor']);
            $data['textcolor'] = attribute_escape($_POST['textcolor']);
            $data['allowLink'] = attribute_escape($_POST['allowLink']);
            update_option('GBMI_Calc_Widget', $data);
        }
    }

    function widget($args, $content=NULL) {

        @extract($args);
        $options = get_option('GBMI_Calc_Widget', $data);
        @extract($options);
        ?>
        <?php $before_widget; ?>

        <script type="text/javascript">
            jQuery(document).ready(function($) {
                childTranslate = {
                    underweight: '<?php _e('underweight', MY_TEXTDOMAIN); ?>',
                    norm: '<?php _e('normal', MY_TEXTDOMAIN); ?>',
                    overweight: '<?php _e('overweight', MY_TEXTDOMAIN); ?>',
                    moderately_obese: '<?php _e('moderately obese', MY_TEXTDOMAIN); ?>',
                    child_res1: "<?php _e("Your child's BMI is:", MY_TEXTDOMAIN); ?>",
                    child_res2: '<?php _e("BMI percentile", MY_TEXTDOMAIN); ?>',
                    child_res3: '<?php _e("This puts you in the", MY_TEXTDOMAIN); ?>',
                    child_res4: '<?php _e("weight range", MY_TEXTDOMAIN); ?>',
                    valid1: '<?php _e("Enter a valid height and weight", MY_TEXTDOMAIN); ?>',
                    valid2: '<?php _e("Enter a valid height", MY_TEXTDOMAIN); ?>',
                    valid3: '<?php _e("Enter a valid weight", MY_TEXTDOMAIN); ?>',
                    valid3: '<?php _e("Enter a valid age", MY_TEXTDOMAIN); ?>'
                };
                			
                $("#bmisubmit").click(function() {
                    var bmi = 0;
                    var height = 0;
                    var weight = 0;

        <?php if ($standard == 'standard') { ?>
                        height = $("[name='bmifeet']").val() * 12 + parseInt($("[name='bmiinches']").val());
                        weight = $("[name='bmipounds']").val() * 703;
        <?php } else { ?>
                        height = $("[name='bmifeet']").val() / 100;
                        weight = $("[name='bmipounds']").val();
        <?php } ?>
                    bmi = weight / Math.pow(height, 2);
                    bmi = Math.round(bmi * 10) / 10;

                    if ($("[name='gender_bmi']").val() == 'Male') {
                        if (bmi < 12) {
                            desiredCat = "<?php _e('severly underweight', MY_TEXTDOMAIN); ?>";
                        }
                        else if (bmi < 20) {
                            desiredCat = "<?php _e('underweight', MY_TEXTDOMAIN); ?>";
                        }
                        else if (bmi < 25) {
                            desiredCat = "<?php _e('normal', MY_TEXTDOMAIN); ?>";
                        }
                        else if (bmi < 30) {
                            desiredCat = "<?php _e('overweight', MY_TEXTDOMAIN); ?>";
                        }
                        else if (bmi < 35) {
                            desiredCat = "<?php _e('moderately obese', MY_TEXTDOMAIN); ?>";
                        }
                        else {
                            desiredCat = "<?php _e('severly obese', MY_TEXTDOMAIN); ?>";
                        }
                    }

                    if ($("[name='gender_bmi']").val() == 'Female') {
                        if (bmi < 12) {
                            desiredCat = "<?php _e('severly underweight', MY_TEXTDOMAIN); ?>";
                        }
                        else if (bmi < 19) {
                            desiredCat = "<?php _e('underweight', MY_TEXTDOMAIN); ?>";
                        }
                        else if (bmi < 24) {
                            desiredCat = "<?php _e('normal', MY_TEXTDOMAIN); ?>";
                        }
                        else if (bmi < 30) {
                            desiredCat = "<?php _e('overweight', MY_TEXTDOMAIN); ?>";
                        }
                        else if (bmi < 35) {
                            desiredCat = "<?php _e('moderately obese', MY_TEXTDOMAIN); ?>";
                        }
                        else {
                            desiredCat = "<?php _e('severly obese', MY_TEXTDOMAIN); ?>";
                        }
                    }

                    if (isNaN(bmi)) {
                        $('#childBMIresults').hide().fadeOut();
                        $('#BMIresults').hide().text('<?php _e('Please enter a valid height and weight.', MY_TEXTDOMAIN); ?>').fadeIn();
                    }
                    else {
                        $('#childBMIresults').hide().fadeOut();
                        $('#BMIresults').hide().html('<?php _e('Your BMI is', MY_TEXTDOMAIN); ?> ' + bmi + ". <br /> <?php _e('This puts you in the', MY_TEXTDOMAIN); ?> " + desiredCat + ".").fadeIn();
                    }
                });

                
                $("#p1B222").change(function() {
                    var bmi = 0;
                    var height = 0;
                    var weight = 0;

        <?php if ($standard == 'standard') { ?>
                        height = $("[name='bmifeet']").val() * 12 + parseInt($("[name='bmiinches']").val());
                        weight = $("[name='bmipounds']").val() * 703;
        <?php } else { ?>
                        height = $("[name='bmifeet']").val() / 100;
                        weight = $("[name='bmipounds']").val();
        <?php } ?>
                    bmi = weight / Math.pow(height, 2);
                    bmi = Math.round(bmi * 10) / 10;

                    if ($("[name='gender_bmi']").val() == 'Male') {
                        if (bmi < 12) {
                            desiredCat = "<?php _e('severly underweight', MY_TEXTDOMAIN); ?>";
                        }
                        else if (bmi < 20) {
                            desiredCat = "<?php _e('underweight', MY_TEXTDOMAIN); ?>";
                        }
                        else if (bmi < 25) {
                            desiredCat = "<?php _e('normal', MY_TEXTDOMAIN); ?>";
                        }
                        else if (bmi < 30) {
                            desiredCat = "<?php _e('overweight', MY_TEXTDOMAIN); ?>";
                        }
                        else if (bmi < 35) {
                            desiredCat = "<?php _e('moderately obese', MY_TEXTDOMAIN); ?>";
                        }
                        else {
                            desiredCat = "<?php _e('severly obese', MY_TEXTDOMAIN); ?>";
                        }
                    }

                    if ($("[name='gender_bmi']").val() == 'Female') {
                        if (bmi < 12) {
                            desiredCat = "<?php _e('severly underweight', MY_TEXTDOMAIN); ?>";
                        }
                        else if (bmi < 19) {
                            desiredCat = "<?php _e('underweight', MY_TEXTDOMAIN); ?>";
                        }
                        else if (bmi < 24) {
                            desiredCat = "<?php _e('normal', MY_TEXTDOMAIN); ?>";
                        }
                        else if (bmi < 30) {
                            desiredCat = "<?php _e('overweight', MY_TEXTDOMAIN); ?>";
                        }
                        else if (bmi < 35) {
                            desiredCat = "<?php _e('moderately obese', MY_TEXTDOMAIN); ?>";
                        }
                        else {
                            desiredCat = "<?php _e('severly obese', MY_TEXTDOMAIN); ?>";
                        }
                    }

                    if (isNaN(bmi)) {
                        $('#childBMIresults').hide().fadeOut();
                        $('#BMIresults').hide().text('<?php _e('Please enter a valid height and weight.', MY_TEXTDOMAIN); ?>').fadeIn();
                    }
                    else {
                        $('#childBMIresults').hide().fadeOut();
                        $('#BMIresults').hide().html('<?php _e('Your BMI is', MY_TEXTDOMAIN); ?> ' + bmi + ". <br /> <?php _e('This puts you in the', MY_TEXTDOMAIN); ?> " + desiredCat + ".").fadeIn();
                    }
                });
                
            });
        </script>

        <script src="<?php echo WP_PLUGIN_URL . '/global-body-mass-index-calculator/js/child.js'; ?>"></script>

        <style type="text/css">
            .ui-widget {
                font-family: Arial, sans-serif;
                font-size: 1.1em;
                font: 12px/20px Arial, sans-serif;
            }
            .ui-widget input, .ui-widget select, .ui-widget textarea, .ui-widget button {
                font-family: Arial, sans-serif;
                font: 12px/20px Arial, sans-serif;
                font-size: 1em;
                color: #000;
                border: 1px solid #aaa;
            }
            .ui-widget select{ padding: 1px;}
            .gbmi_div {
                color: <?php echo $textcolor ? $textcolor : "#000" ?>;
                background-color: <?php echo $bgcolor ? $bgcolor : '#ffffff' ?>;
                background-image: -moz-linear-gradient(top, <?php echo $bgcolor ? $bgcolor : '#ffffff' ?>, <?php echo $bgendcolor ? $bgendcolor : '#ffffff' ?>);
                background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, <?php
        echo $bgcolor ? $bgcolor : '#ffffff'
        ?>), color-stop(1, <?php echo $bgendcolor ? $bgendcolor : '#ffffff' ?>) );
                filter: progid:DXImageTransform.Microsoft.gradient(startColorStr = '<?php echo $bgcolor ? $bgcolor : '#ffffff' ?>', EndColorStr = '<?php echo $bgendcolor ? $bgendcolor : '#ffffff' ?>' );
                -ms-filter: \" progid: DXImageTransform . Microsoft . gradient(startColorStr = '<?php echo $bgcolor ? $bgcolor : '#ffffff' ?>', EndColorStr = '<?php echo $bgendcolor ? $bgendcolor : '#ffffff' ?>' ) \";
            }
            .gbmi_div div label, .gbmi_div div h4 {
                color: <?php echo $textcolor ? $textcolor : "#000" ?> !important;
            }

            a.current{
                background:<?php echo $currtabcolor ? $currtabcolor . ' !important' : '#ccc !important'; ?>;
            }
            ul.tabs a{
                background:<?php echo $tabcolor ? $tabcolor : '#fff'; ?>;
            }

        </style>

        <div id="gdmi-tabs"
             style="height: <?php echo $height ? $height : "#auto" ?>px; width: <?php echo $width ? $width : "300" ?>px;">
            <ul class="tabs">
                <li><a href="#grown"><?php _e('Grown ups', MY_TEXTDOMAIN); ?></a></li>
                <li><a href="#child"><?php _e('Child', MY_TEXTDOMAIN); ?></a></li>
            </ul>

            <div class="panes">

                <div id="grown" class="tabbed">
                    <div class="gbmi_div">
                        <h2><?php echo $title; ?></h2>
                        <div class="gender_select">
                            <label for="p1B222"><?php _e('Gender', MY_TEXTDOMAIN); ?>:</label>
                            <select id="p1B222" tabindex="1" name="gender_bmi">
                                <option value="Male" selected="selected"><?php _e('Male', MY_TEXTDOMAIN); ?></option>
                                <option value="Female"><?php _e('Female', MY_TEXTDOMAIN); ?></option>
                            </select>
                        </div>
        <?php if ($standard == 'standard') { ?>
                            <div>
                                <label for="bmifeet"><?php _e('Height', MY_TEXTDOMAIN); ?>:</label>
                                <input name="bmifeet" class="input_fw"/> <?php _e('ft', MY_TEXTDOMAIN); ?> <input name="bmiinches" style="width: 30px;"/> in
                            </div>
                            <div>
                                <label for="bmipounds"><?php _e('Weight', MY_TEXTDOMAIN); ?>:</label>
                                <input name="bmipounds" class="input_fw"/> <?php _e('pounds', MY_TEXTDOMAIN); ?>
                            </div>
        <?php } else { ?>
                            <div>
                                <label for="bmifeet"><?php _e('Height', MY_TEXTDOMAIN); ?>:</label>
                                <input name="bmifeet" class="input_fw"/><span class="bmipounds"><?php _e('cm', MY_TEXTDOMAIN); ?></span>
                            </div>

                            <div>
                                <label for="bmipounds"><?php _e('Weight', MY_TEXTDOMAIN); ?>:</label>
                                <td><input name="bmipounds" class="input_fw"><span class="bmipounds"><?php _e('kg', MY_TEXTDOMAIN); ?></span>
                                </td>
                            </div>
        <?php } ?>
                        <div>
                            <label>&nbsp;</label>
                            <input id="bmisubmit" type="button" value="<?php _e('Get BMI!', MY_TEXTDOMAIN); ?>" class="bmisubmit"
                                   style="color:<?php echo $textcolor ? $textcolor : "#000" ?>;
                                   background-color: <?php echo $bgcolor ? $bgcolor : "#e5e5e5" ?>;" />
                        </div>

        <?php if ($allowLink == 'yes') { ?>
                            <a href="http://www.gesundesabnehmen.at/" title="BMI Rechner - Gesund Abnehmen, Diaeten und Ern&auml;hrung"
                               style="text-decoration: underline; color: #ccc;"><?php _e('by gesundesabnehmen.at', MY_TEXTDOMAIN); ?></a>
        <?php } else
             ?>
                    </div>
                </div>

                <div id="child" class="tabbed">
                    <div class="gbmi_div">
                        <div>
                            <h2><?php echo $title; ?></h2>
                            <h2 id="infotext"><?php _e('Child BMI calculator is only valid for children between 2 and 20 years.', MY_TEXTDOMAIN); ?></h2>
                        </div>

                        <form id="formc" name="formc" action="" method="post">
                            <div class="gender_select">
                                <label for="p1B2"><?php _e('Gender', MY_TEXTDOMAIN); ?>:</label>
                                <select id="p1B2" tabindex="1">
                                    <option value="Male" selected="selected"><?php _e('Male', MY_TEXTDOMAIN); ?></option>
                                    <option value="Female"><?php _e('Female', MY_TEXTDOMAIN); ?></option>
                                </select>
                            </div>
                            <div class="age_select">
                                <label for="p1B3"><?php _e('Age', MY_TEXTDOMAIN); ?>: <span>(<?php _e('Jahre', MY_TEXTDOMAIN); ?>)</span></label>
                                <select id="p1B3" name="p1B3">
                                    <?php for ($i = 2; $i < 21; $i++) { ?>
                                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                    <?php } ?>
                                </select>
                                    
                            </div>

                            <div><label for="p1B4"><?php _e('Height', MY_TEXTDOMAIN); ?>:</label>
                                <input id="p1B4" class="input_fw" value="107" name="p1B4"/>
        <?php if ($standard == 'standard') { ?>
                                    <?php _e('inches', MY_TEXTDOMAIN); ?>
                                    <input id="p1C4" type="hidden" value="inches" name="p1C4"/>
                                <?php } else { ?>
                                    <?php _e('cm', MY_TEXTDOMAIN); ?>
                                    <input id="p1C4" type="hidden" value="centimeters" name="p1C4"/>
                                <?php } ?>
                            </div>
                            <div>
                                <label for="p1B5"><?php _e('Weight', MY_TEXTDOMAIN); ?>:</label>
                                <input id="p1B5" class="input_fw" value="18" name="p1B5"/>
        <?php if ($standard == 'standard') { ?>
                                    <?php _e('pounds', MY_TEXTDOMAIN); ?>
                                    <input id="p1C5" type="hidden" value="pounds" name="p1C5"/>
                                <?php } else { ?>
                                    <?php _e('kg', MY_TEXTDOMAIN); ?>
                                    <input id="p1C5" type="hidden" value="kilograms" name="p1C5"/>
                                <?php } ?>
                            </div>

                            <div>
                                <label>&nbsp;</label>
                                <input type="button" id="childbmisubmit" class="bmisubmit"
                                       value="<?php _e('Get child BMI!', MY_TEXTDOMAIN); ?>"
                                       style="color:<?php echo $textcolor ? $textcolor : "#000" ?>;
                                       background-color: <?php echo $bgcolor ? $bgcolor : "#e5e5e5" ?>;" />
                            </div>
        <?php if ($allowLink == 'yes') { ?>
                                <div style="display: none";>
                                     <a href=" http://www.gesundesabnehmen.at/"
                                   style="text-decoration: underline; color: <?php echo $textcolor ? $textcolor : "#ffffff" ?>;"><?php _e('GBMI Calculator', MY_TEXTDOMAIN); ?></a>
                                </div>
        <?php } ?>
                            <script language="JavaScript" type="text/javascript">recalc_onclick('');  </script>
                        </form>
                    </div>
                </div>
            </div>

            <div id="BMIresults"></div>
            <div id="childBMIresults"></div>
        </div>

        <?php
        echo $after_widget; 

    }  // widget() function closed

    function register() {
        register_sidebar_widget('GBMI Calculator', array('GBMI_Calc_Widget', 'widget'));
        register_widget_control('GBMI Calculator', array('GBMI_Calc_Widget', 'control'));
    }
}

// class closed

add_shortcode('gbmicalc', array('GBMI_Calc_Widget', 'widget'));
add_action('widgets_init', array('GBMI_Calc_Widget', 'register'));

add_action('admin_menu', 'gbmi_menu');

function gbmi_menu() {
    add_submenu_page('options-general.php', 'GBMI Calculator Settings', 'GBMI Calculator', 'add_users', 'gbmi_calculator', 'gbmi_calc_settings');
    add_action('admin_init', 'register_my_settings');
}

function register_my_settings() {
    register_setting('gbmi-settings-group', 'title');
}

#########################################################settings########################################################

function gbmi_calc_settings() {

    $data = get_option('GBMI_Calc_Widget'); ?>
    <script src="<?php echo WP_PLUGIN_URL . '/global-body-mass-index-calculator/js/calcs.js'; ?>"></script>    
    <div class="wrap">
        <h2>Global Body Mass Index Calculator Settings</h2>

        <form method="post" action="">
    <?php settings_fields('gbmi-settings-group'); ?>
            <table class="form-table">
                <p><label>Title<input name="title" type="text" value="<?php echo $data['title']; ?>"/></label></p>

                <p><label>Calculator Mode
                        <select name="standard">
                            <option <?php echo $data['standard'] == "standard" ? "selected" : " " ?> value="standard">Standard</option>
                            <option <?php echo $data['standard'] == "metric" ? "selected" : " " ?> value="metric"> Metric</option>
                        </select>
                    </label></p>

                <p><label>Params<br/>
                        Height: <input type="text" name="height" type="text"
                                       value="<?php echo $data['height'] ? $data['height'] : "auto" ?>"/>
                        Width: <input type="text" name="width" type="text"
                                      value="<?php echo $data['width'] ? $data['width'] : "300" ?>"/>
                    </label>
                </p>

                <div class="colorHolder">
                    <div class="colorSelector" id="tabColorSelector1">
                        <div id="tabcolor" style="background-color: <?php echo $data['tabcolor']; ?>"></div>
                    </div>
                    <span>Tab Color</span>
                </div>
                
                <div class="colorHolder">
                    <div class="colorSelector" id="currtabColorSelector1">
                        <div id="currtabcolor" style="background-color: <?php echo $data['currtabcolor']; ?>"></div>
                    </div>
                    <span>Current Tab Color</span>
                </div>

                <div class="colorHolder">
                    <div class="colorSelector" id="bgColorSelector1">
                        <div id="widgetBackground" style="background-color: <?php echo $data['bgcolor']; ?>"></div>
                    </div>
                    <span>Widget Start Background Color</span>
                </div>

                <div class="colorHolder">
                    <div class="colorSelector" id="bgEndColorSelector1">
                        <div id="widgetEndBackground" style="background-color: <?php echo $data['bgendcolor']; ?>"></div>
                    </div>
                    <span>Widget End Background Color</span></div>

                <div class="colorHolder">
                    <div class="colorSelector" id="textColorSelector1">
                        <div id="widgetText" style="background-color: <?php echo $data['textcolor']; ?>"></div>
                    </div>

                    <span>Widget Text Color</span></div>

                <input name="bgcolor" type="hidden" value="<?php echo $data['bgcolor']; ?>"/></label>
                <input name="bgendcolor" type="hidden" value="<?php echo $data['bgendcolor']; ?>"/>
                <input name="textcolor" type="hidden" value="<?php echo $data['textcolor']; ?>"/>
                <input name="tabcolor" type="hidden" value="<?php echo $data['tabcolor']; ?>"/>
                <input name="currtabcolor" type="hidden" value="<?php echo $data['currtabcolor']; ?>"/>
              
                <div id="bmitabDemo" 
                     style="color: #000000; 
                     border: 1px solid rgba(21, 11, 11, 0.199219); padding: 5px; width: 200px; background-color: <?php echo $data['tabcolor']; ?>; 
                     -moz-border-radius: 12px; -webkit-border-radius: 12px; border-radius: 12px; -moz-box-shadow: 0px 0px 4px #ffffff; 
                     -webkit-box-shadow: 0px 0px 4px #ffffff; box-shadow: 0px 0px 4px #ffffff;text-shadow: 1px 1px 3px #888;">
                    Tab Color Preview
                </div>
  <br/>
                 <div id="bmicurrtabDemo" 
                     style="color: #000000; 
                     border: 1px solid rgba(21, 11, 11, 0.199219); padding: 5px; width: 200px; background-color: <?php echo $data['currtabcolor']; ?>; 
                     -moz-border-radius: 12px; -webkit-border-radius: 12px; border-radius: 12px; -moz-box-shadow: 0px 0px 4px #ffffff; 
                     -webkit-box-shadow: 0px 0px 4px #ffffff; box-shadow: 0px 0px 4px #ffffff; text-shadow: 1px 1px 3px #888;">
                    Current Tab Color Preview
                </div>
  <br/>
                <div id="bmiCalcDemo" 
                     style="color: <?php echo $data['textcolor']; ?>; 
                     border: 1px solid rgba(21, 11, 11, 0.199219); padding: 5px; width: 200px; 
                     -moz-border-radius: 12px; -webkit-border-radius: 12px; border-radius: 12px; -moz-box-shadow: 0px 0px 4px #ffffff; 
                     -webkit-box-shadow: 0px 0px 4px #ffffff; box-shadow: 0px 0px 4px #ffffff; background-color: <?php echo $data['bgcolor']; ?>; 
                     background-image: -moz-linear-gradient(top, <?php echo $data['bgcolor']; ?>, <?php echo $data['bgendcolor']; ?>); 
                     background-image: -webkit-gradient(linear,left top,left bottom,color-stop(0, <?php echo $data['bgcolor']; ?>),color-stop(1, <?php echo $data['bgendcolor']; ?>)); 
                     filter:  progid:DXImageTransform.Microsoft.gradient(startColorStr='<?php echo $data['bgcolor']; ?>', EndColorStr='<?php echo $data['bgendcolor']; ?>'); -ms-filter: \"
                     progid:DXImageTransform.Microsoft.gradient(startColorStr='<?php echo $data['bgcolor']; ?>', EndColorStr='<?php echo $data['bgendcolor']; ?>')\"; 
                     text-shadow: 1px 1px 3px #888;">
                    Widget Color Preview
                </div>
                <p><label>Allow link back to www.gesundesabnehmen.at&nbsp;&nbsp;<input name="allowLink" type="checkbox"
                                                                           value="yes" <?php echo $data['allowLink'] == 'yes' ? "checked" : "" ?>/></label>
                </p>  

            </table>
            <p class="submit">
                <input id="Button1" type="submit" class="button-primary" value="Save changes" name="submit" />
            </p>
        </form>
    </div>

    <?php
    if (isset($_POST['submit'])) {
        $data['title'] = attribute_escape($_POST['title']);
        $data['standard'] = attribute_escape($_POST['standard']);
        $data['height'] = attribute_escape($_POST['height']);
        $data['width'] = attribute_escape($_POST['width']);
        $data['bgcolor'] = attribute_escape($_POST['bgcolor']);
        $data['bgendcolor'] = attribute_escape($_POST['bgendcolor']);
        $data['textcolor'] = attribute_escape($_POST['textcolor']);
        $data['allowLink'] = attribute_escape($_POST['allowLink']);
        $data['tabcolor'] = attribute_escape($_POST['tabcolor']);
        $data['currtabcolor'] = attribute_escape($_POST['currtabcolor']); 
        update_option('GBMI_Calc_Widget', $data); 
        $page = get_bloginfo('url') . '/wp-admin/options-general.php?page=gbmi_calculator'; 
       
        $sec = 0;
        header("Refresh: $sec; url=$page");
 }
}

function add_scripts() {
    ?>
	
	
    <?php if( wp_get_theme() == "Propulsion" ) { 
		if(!is_front_page()) {
	?>
		<script type="text/javascript" src="<?php echo plugin_dir_url(''); ?>gbmicalc/js/jquery.tools.min.js"></script>
	<?php } 
	} 
	else { ?>
		<script type="text/javascript" src="<?php echo plugin_dir_url(''); ?>gbmicalc/js/jquery.tools.min.js"></script>
	<?php } ?>
	
    <link rel="stylesheet" type="text/css" href="<?php echo plugin_dir_url(''); ?>gbmicalc/css/tab.css" />
    <style type="text/css">
        .panes div.tabbed {
            display:none;		
            border:1px solid #999;
        }
    </style>
    <script type="text/javascript">
        $(function() {
            $("ul.tabs").tabs("div.panes > div.tabbed");
           // $('ul.tabs li:last').css({'width':'49%', 'border':'none' });
        });
    </script>
    <?php
}

add_action('wp_head', 'add_scripts');
?>