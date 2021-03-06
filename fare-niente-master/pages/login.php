<?php 
  include_once('../includes/session.php');
  include_once('../templates/tpl_common.php');
  include_once('../templates/tpl_auth.php');

  // Verify if user is logged in
  if (isset($_SESSION['username']))
    die(header('Location: list.php'));

  $users = getAllUsers();
  var_dump($users);

  draw_header(null);
  draw_login();
  draw_footer();
?>