<?php include_once('includes/load.php'); ?>
<?php

$req_fields = array('username', 'password');
validate_fields($req_fields);
$username = make_HTML_compliant($_POST['username']);
$password = make_HTML_compliant($_POST['password']);

if (empty($errors)) {

    $user = authenticate_user($username, $password);

    if ($user) {

        $session->login($user['id']);
        updateLastLogIn($user['id']);

            if ($user['user_level'] === '1') {

                $session->msg("s", "Hello " . $user['username'] . ", Welcome to the Inventory.");
                redirect_to_page('admin.php', false);

            } elseif ($user['user_level'] === '2') {

                $session->msg("s", "Hello " . $user['username'] . ", Welcome to the Inventory.");
                redirect_to_page('special.php', false);

            } else {

                $session->msg("s", "Hello " . $user['username'] . ", Welcome to the Inventory.");
                redirect_to_page('home.php', false);

            }


    } else {

        $session->msg("d", "Sorry Username/Password incorrect.");
        redirect_to_page('index.php', false);
    }

} else {

    $session->msg("d", $errors);
    redirect_to_page('login.php', false);
}

?>
