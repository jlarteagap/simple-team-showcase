<?php

add_action('admin_menu', 'team_settings');

function team_settings() {
    add_submenu_page(
        'edit.php?post_type=team',
        'Settings',
        'Settings',
        'manage_options',
        'settings',
        'team_settings_page'
    );
}
function team_settings_page(){
    require(TEAM_PATH.'inc/team_settings_page.php');
}