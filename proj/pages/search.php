<?php
include('../templates/tpl_common.php');
include('../templates/tpl_pages.php');
include_once('../includes/session.php');
include_once('../database/db_functions.php');



if (!isset($_GET['city_id']) || ($city_id = intval($_GET['city_id'])) === 0 || !isset($_GET['country_id']) || ($country_id = intval($_GET['country_id'])) === 0 || !isset($_GET['gn']) ||  ($guest_no = intval($_GET['gn'])) === 0 || $guest_no > 9) {
    header("Location: 404.php");
}

if (!isset($_GET['ed']) && !isset($_GET['sd'])) {

    
    $house_list = find_houses_in_location($city_id, $guest_no);

    if (!isset($_SESSION['username'])) $usr = null;
    else $usr = $_SESSION['username'];

    global $main_stylesheet, $fonts, $search_sl;
    open_html();
    draw_head(get_title("search"), [$main_stylesheet, $fonts[0], $fonts[1], $fonts[2]], $search_sl);
    open_body();
    open_overlay();
    draw_header($usr, 'search');
    draw_search_page($city_id, $country_id, "", "", $guest_no, $house_list);
    footer();
    close_overlay();
    close_body();
    close_html();



} else if (isset($_GET['ed']) && isset($_GET['sd'])) {
    if (strlen($_GET['sd']) != 10 || strlen($_GET['ed']) != 10)
        header("Location: 404.php");

    $start_date = $_GET['sd'];
    $end_date = $_GET['ed'];

    $house_list = find_me_a_cozy_place($city_id, $start_date, $end_date, $guest_no);

    if (!isset($_SESSION['username'])) $usr = null;
    else $usr = $_SESSION['username'];

    global $main_stylesheet, $fonts, $search_sl;
    open_html();
    draw_head(get_title("search"), [$main_stylesheet, $fonts[0], $fonts[1], $fonts[2]], $search_sl);
    open_body();
    open_overlay();
    draw_header($usr, 'search');
    draw_search_page($city_id, $country_id, $start_date, $end_date, $guest_no, $house_list);
    footer();
    close_overlay();
    close_body();
    close_html();

} else {
    header("Location: 404.php");
}
