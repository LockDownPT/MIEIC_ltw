
<?php 
include_once('../database/db_functions.php'); 

function open_html()
{
  echo "<!DOCTYPE html>";
  echo "<html>";
}
?>

<?php function close_html()
{
  echo "</html>";
}
?>

<?php function open_head()
{
  echo "<head>";
}
?>

<?php function close_head()
{
  echo "</head>";
}
?>

<?php function set_title($title)
{
  echo "<title>$title</title>";
}
?>

<?php function set_charset($charset)
{
  echo "<meta charset=\"$charset\">";
}
?>

<?php function link_stylesheets($stylesheet_list)
{
  foreach ($stylesheet_list as $stylesheet) {
    echo "<link rel=\"stylesheet\" href=$stylesheet crossorigin=\"anonymous\">";
  }
}
?>

<?php function link_scripts($script_list)
{
  foreach ($script_list as $script) {
    echo "<script src=$script[0]";
    if ($script[0][strlen($script[0]) - 3] == 'm') echo " type=\"module\""; //Check if its a module
    if ($script[1]) echo " defer";
    echo "></script>";
  }
}
?>

<?php function draw_head($title, $stylesheet_list = [], $script_list = [], $charset = "utf-8")
{
  open_head();
  set_title($title);
  set_charset($charset);
  link_stylesheets($stylesheet_list);
  link_scripts($script_list);
}
?>

<?php function open_body()
{
  echo "<body>";
}
?>

<?php function close_body()
{
  echo "</body>";
}
?>

<?php function open_header()
{
  echo "<header>";
}
?>

<?php function close_header()
{
  echo "</header>";
}
?>

<?php function draw_green_bar()
{
  echo "<div id=\"green_bar\"></div>";
}
?>

<?php function open_nav()
{
  echo "<nav id=\"registernav\">";
}
?>

<?php function close_nav()
{
  echo "</nav>";
}
?>

<?php function open_table()
{
  echo "<table>";
}
?>

<?php function close_table()
{
  echo "</table>";
}
?>

<?php function open_tr()
{
  echo "<tr>";
}
?>

<?php function close_tr()
{
  echo "</tr>";
}
?>

<?php function open_td()
{
  echo "<td>";
}
?>

<?php function close_td()
{
  echo "</td>";
}
?>

<?php function draw_logo()
{
  echo "<div id=\"logoText\">";
  echo "<a href=\"../pages/homepage.php\"><img src=\"../assets/logo2.png\" alt=\"Logo for the AirestivoBnB\"> </a>";
  echo "</div>";
}
?>

<?php function draw_profile_menu($username)
{
  $photo = get_photo_from_usr($username);
  if($photo == null) $photo = "..\assets\profile.jpg";
  echo "<img id=\"profile_img\" src=$photo alt=\"profile_picture\" height=\"50\" width=\"50\"><br>";
  echo "<div id=\"profileMenu\">";
  echo "<button id=\"dropdown\"> $username </button>";
  echo "<div id=\"dropdownList\">";
  echo "<button id= \"edit\" onclick=\"window.location.href = 'editprofile.php';\">Profile</button>";
  echo "<a href=\"../actions/action_logout.php\">Logout</a>";
  echo "</div>";
  echo "</div>";
}
?>

<?php function draw_properties_menu()
{
  echo "<div id=\"propertiesMenu\">";
  echo "<button id= \"properties\" onclick=\"window.location.href = 'myProperties.php';\">My Properties</button>";
  echo "</div>";
}
?>

<?php function draw_reservations_menu()
{
  echo "<div id=\"reservationsMenu\">";
  echo "<button id= \"reservations\" onclick=\"window.location.href = 'myReservations.php';\">My Reservations</button>";
  echo "</div>";
}
?>

<?php function draw_messages_menu(){
      echo "<div id=\"messagesMenu\">";
      echo "<button id= \"reservations\" onclick=\"window.location.href = 'myMessages.php';\">My Messages</button>";
      echo "</div>";
} 
?>


<?php $fonts = [
  "https://use.fontawesome.com/releases/v5.3.1/css/all.css",
  "https://fonts.googleapis.com/css?family=Merriweather|Open+Sans+Condensed:300",
  "https://fonts.googleapis.com/css?family=Poppins&display=swap"
];

$main_stylesheet = "../css/style.css";

$register_sl = [["../js/register.js", true]];

$search_sl = [["../js/search.js", true]];

$edit_sl = [["../js/edit.js", true]];
$logged_house_sl = [["../js/rent.js", true], ["../js/slide.js", true]];

$not_logged_house_sl = [["../js/not_logged_buttons.js", true], ["../js/slide.js", true]];


$myProperties_sl = [["../js/myProperty.js", true]];


 $fonts = ["https://use.fontawesome.com/releases/v5.3.1/css/all.css",
                "https://fonts.googleapis.com/css?family=Merriweather|Open+Sans+Condensed:300",
                "https://fonts.googleapis.com/css?family=Poppins&display=swap"];
      
      $main_stylesheet = "../css/style.css";

      $register_sl = [["../js/register.js", true]];
      $search_sl = [["../js/search.js", true]];
      $edit_sl = [["../js/edit.js", true]];
      $logged_house_sl = [["../js/rent.js", true], ["../js/slide.js", true]];
      $not_logged_house_sl = [["../js/not_logged_buttons.js", true], ["../js/slide.js", true]];
      $message_sl = [["../js/messages.js", true]];
      $myReservations_sl = [["../js/myReservation.js", true]];

      $addProperty_sl = [["../js/addProperty.js", true]];

      $editProperty_sl = [["../js/editProperty.js", true]];


?>

<?php function draw_logged_header($username)
{
  open_nav();
  open_table();
  open_tr();

  open_td();
  draw_logo();
  close_td();

  open_td();
  echo "<div id=\"flexboxMenu\">";
  draw_profile_menu($username);
  draw_properties_menu();
  draw_reservations_menu();
  draw_messages_menu();
  echo "<div>";
  close_td();

  close_tr();
  close_table();
  draw_green_bar();
  close_nav();
};
?>

<?php function draw_login_button()
{
  echo "<form>";
  echo "<button id=\"loginButtonR\" formaction=\"./login.php\" formmethod=\"post\">Login</button>";
  echo "</form>";
}
?>

<?php function draw_not_logged_header()
{
  open_nav();
  open_table();
  open_tr();

  open_td();
  draw_logo();
  close_td();

  open_td();
  draw_login_button();
  close_td();

  close_tr();
  close_table();
  draw_green_bar();
  close_nav();
}
?>

<?php function get_title($page)
{
  switch ($page) {
    case "register":
      return "Register";
    case "login":
      return "Log In";
    case "404":
      return "Error 404";
    case "403":
      return "Error 403";
    case "editProperty":
      return "Edit Property";
    case "addProperty":
      return "Add Property";
    case "editProfile":
      return "Edit Profile";
    case "search":
      return "Search";
    case "myReservations":
      return "My Reservations";
    case "myProperties":
      return "My Properties";
    case "homepage":
      return "Homepage";
    case "housepage":
      return "Housepage";
    case "403":
      return "Error 403";
    default:
      return "AirestivoBnB";
  }
}
?>


<?php
function draw_pic($picpath, $alt)
{
  echo "<img src=$picpath alt=$alt />";
}
?>

<?php
function h1($content)
{
  echo "<h1> $content </h1>";
}
?>

<?php
function h2($content)
{
  echo "<h2> $content </h2>";
}
?>

<?php
function h3($content)
{
  echo "<h3> $content </h3>";
}
?>

<?php
function h4($content)
{
  echo "<h4> $content </h4>";
}
?>

<?php
function open_overlay()
{
  echo "<div id=\"overlay\">";
}

function close_overlay()
{
  echo "</div>";
}
?>
<?php function draw_header($username, $page)
{
  open_header();  
  if ($page != "login") {
    if ($username != NULL) draw_logged_header($username);
    else draw_not_logged_header();
  }
  close_header();
}
?>



<?php function footer()
{
  echo "<footer>  © 2019 AirestivoBnB, Inc. All rights reserved. </footer>";
}
?>