<?php
include('../templates/tpl_common.php');
include('../templates/tpl_pages.php');
include_once('../includes/session.php');
include_once('../database/db_functions.php');


if (!isset($_SESSION['username'])) die(header('Location: homepage.php'));
else $usr = $_SESSION['username'];

$usrid = get_id_from_usr($usr);
$contacts = get_usr_contacts($usrid);

open_html();
draw_head(get_title("myMessages"), [$main_stylesheet, $fonts[0], $fonts[1], $fonts[2]], $message_sl);
open_body();
open_overlay();
draw_header($usr, "myMessages"); 
draw_my_messages($contacts, $usrid);
footer();
close_overlay();
close_body(); 
close_html();
?>