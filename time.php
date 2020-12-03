<?php
function get_notification_count_by_status_new()
{
    $wpdb = mysqli_connect(localhost, root, root, drs);
    $notifications_count = mysqli_query($wpdb, "SELECT * FROM `wp_notifications` WHERE notification_status = 'new'");
	//var_dump($notifications_count);
	$notifications_count = mysqli_num_rows($notifications_count);
    return $notifications_count;
}


                
                if (get_notification_count_by_status_new() > 0) {
                 
$putot = get_notification_count_by_status_new();				 
$dekget = <<<dekget
                    <span type="button" class="bell-icon mr-3" data-toggle="modal"
                          data-counter="$putot"
                          data-target="#notificationsPopup">
                        <i class="fa fa-bell fa-2x"></i>
                    </span>
dekget;

                    
                }
				
echo $dekget;
				?>