
<?php
function wpac_settings_page_html() {

 //Check if current user have admin access.
    if(!is_admin()) {
        return;
    }
   ?>
     <div class="wrap">
                <h1 style="padding:10px; background:#333;color:#fff"><?=esc_html(get_admin_page_title()); ?></h1>         
            <form action="options.php" method="post">
                <?php
                 settings_fields( 'wpac-settings');
                  do_settings_sections( 'wpac-settings');
                   submit_button( 'Save Changes' );
               ?>
            </form>
   <?php
}

//Top Level Administration Menu
function wpac_register_menu_page() {
    add_menu_page( 'Like System', 'Like Settings', 'manage_options', 'wpac-settings', 'wpac_settings_page_html', 'dashicons-thumbs-up', 30 );
}
add_action('admin_menu', 'wpac_register_menu_page');

function wpac_plugin_settings(){

    // register 2 new field like/dislike
    register_setting( 'wpac-settings', 'wpac_like_btn_label' );
    register_setting( 'wpac-settings', 'wpac_dislike_btn_label' );

    // register a new section for like
    add_settings_section( 'wpac_label_settings_section', 'Button Labels', 'wpac_plugin_settings_section_cb', 'wpac-settings' );

    // register a new field for like
    add_settings_field( 'wpac_like_label_field', 'Like Button Label', 'wpac_like_label_field_cb', 'wpac-settings', 'wpac_label_settings_section' );
    // register a new field for dislike
    add_settings_field( 'wpac_dislike_label_field', 'Dislike Button Label', 'wpac_dislike_label_field_cb', 'wpac-settings', 'wpac_label_settings_section' );
}
add_action('admin_init', 'wpac_plugin_settings');

// Section callback function
function wpac_plugin_settings_section_cb(){
    echo '<p>Define Button Labels</p>';
}

// Field callback function for like
function wpac_like_label_field_cb(){ 

    $setting = get_option('wpac_like_btn_label');
    // output the field
    ?>
    <input type="text" name="wpac_like_btn_label" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
    <?php
}

//filed callback function for dislike
function wpac_dislike_label_field_cb(){ 
    
    $setting = get_option('wpac_dislike_btn_label');
    // output the field
    ?>
    <input type="text" name="wpac_dislike_btn_label" value="<?php echo isset( $setting ) ? esc_attr( $setting ) : ''; ?>">
    <?php
}
