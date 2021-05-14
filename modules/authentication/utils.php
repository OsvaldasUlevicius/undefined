<?php

date_default_timezone_set('Europe/Vilnius');

function checkPasswordStrength($password1, $password2) {

    $passwordStrengthErrors = array();

    $passwordMinimumLength = 8;
    $passwordMaximumLength = 30;

	if (
        (strlen($password1) < $passwordMinimumLength or strlen($password2) < $passwordMinimumLength)
        or
        (strlen($password1) > $passwordMaximumLength or strlen($password2) > $passwordMaximumLength)
    ) {
		array_push($passwordStrengthErrors, "Password must be between 8 and 30 characters");
	}

	if (!preg_match("#[0-9]+#", $password1) or !preg_match("#[0-9]+#", $password2)) {
		array_push($passwordStrengthErrors, "Password must contain at least one number digit (0 - 9)");
	}

	if (!preg_match("#[a-z]+#", $password1) or !preg_match("#[a-z]+#", $password2)) {
		array_push($passwordStrengthErrors, "Password must contain at least one lowercase letter (a - z)");
	}

	if (!preg_match("#[A-Z]+#", $password1) or !preg_match("#[A-Z]+#", $password2)) {
		array_push($passwordStrengthErrors, "Password must contain at least one uppercase, or capital, letter (A - Z)");
	}

	if (!preg_match("/[\'^£$%&*()}{@#~?><>,|=_+!-]/", $password1) or !preg_match("/[\'^£$%&*()}{@#~?><>,|=_+!-]/", $password2)) {
		array_push($passwordStrengthErrors, "Password must contain at least one special character ($, #, @, !,%,^,&,*, etc.)");
	}

	return $passwordStrengthErrors;

}

function logUserActions($userId, $db, $event) {
    $datetime = date_create()->format('Y-m-d H:i:s');
    $eventQuery = "INSERT INTO events (happened_at, event, user_id) VALUES ('$datetime', '$event', '$userId')";
    mysqli_query($db, $eventQuery);
}

?>
