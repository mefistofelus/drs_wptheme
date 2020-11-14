<?php
// wordpress custom notifications
function create_table()
{
    global $wpdb;

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';

    $table_name = $wpdb->get_blog_prefix() . 'notifications';
    $charset_collate = "DEFAULT CHARACTER SET {$wpdb->charset} COLLATE {$wpdb->collate}";

    $sql = "CREATE TABLE {$table_name} (
	id  bigint(20) unsigned NOT NULL auto_increment,
	user_name varchar(50) NOT NULL default '',
	user_state varchar(50) NOT NULL default '',
	notification_text longtext NOT NULL default '',
	notification_status varchar(50) NOT NULL default 'new',
	user_email varchar(50) NOT NULL default '',
	user_phone varchar(50) NOT NULL default '',
	PRIMARY KEY  (id),
	KEY user_name (user_name)
	)
	{$charset_collate};";

    dbDelta($sql);
}

create_table();

// Добавление нового обращения через форму
function add_notification()
{
    global $wpdb;
    $wpdb->insert(
        'wp_notifications',
        array(
            'user_name' => $_POST['user_name'],
            'user_state' => $_POST['user_state'],
            'notification_text' => $_POST['notification_text'],
            'user_email' => $_POST['user_email'],
            'user_phone' => $_POST['user_phone'],
        ),
        array(
            '%s',
            '%s',
            '%s',
            '%s',
            '%d'
        )
    );
}

add_notification();

// Получение общего количества обращений
function get_notification_count()
{
    global $wpdb;
    $notifications_count = $wpdb->get_var("SELECT COUNT(*) FROM `wp_notifications`;");
    return $notifications_count;
}