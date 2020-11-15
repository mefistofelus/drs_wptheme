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
	notification_text text(300) NOT NULL default 'Dont wanna write anything...',
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

// Удаление (смена статуса) уведомления по ссылке с GET параметром
if (isset($_GET['del'])) {
    $id = $_GET['del'];

    global $wpdb;
    $wpdb->update('wp_notifications',
        array('notification_status' => 'deleted'),
        array('ID' => $id,)
    );

}

// Выполнение (смена статуса) уведомления по ссылке с GET параметром
if (isset($_GET['upd'])) {
    $id = $_GET['upd'];

    global $wpdb;
    $wpdb->update('wp_notifications',
        array('notification_status' => 'done'),
        array('ID' => $id,)
    );
}

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
function get_notification_count_by_status_new()
{
    global $wpdb;
    $notifications_count = $wpdb->get_var("SELECT COUNT(*) FROM `wp_notifications` WHERE notification_status = 'new'");
    return $notifications_count;
}

// Получение списка обращений со статусом "новые"
function get_notifications_list_by_status_new()
{
    global $wpdb;
    $notifications_list_by_status_new = $wpdb->get_results("SELECT * FROM wp_notifications WHERE notification_status = 'new' ORDER BY id ASC", ARRAY_A);
    return $notifications_list_by_status_new;
}

// Получение списка обращений со статусом "выполненные"
function get_notifications_list_by_status_done()
{
    global $wpdb;
    $notifications_list_by_status_done = $wpdb->get_results("SELECT * FROM wp_notifications WHERE notification_status = 'done' ORDER BY id ASC", ARRAY_A);
    return $notifications_list_by_status_done;
}

// Получение списка обращений со статусом "удаленные"
function get_notifications_list_by_status_deleted()
{
    global $wpdb;
    $notifications_list_by_status_deleted = $wpdb->get_results("SELECT * FROM wp_notifications WHERE notification_status = 'deleted' ORDER BY id ASC", ARRAY_A);
    return $notifications_list_by_status_deleted;
}
