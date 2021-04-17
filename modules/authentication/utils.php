<?php

function checkPasswordStrength($password1, $password2) {

    $passwordStrengthErrors = array();

    $passwordMinimumLength = 8;
    $passwordMaximumLength = 30;

	if (
        (strlen($password1) < $passwordMinimumLength or strlen($password2) < $passwordMinimumLength)
        or
        (strlen($password1) > $passwordMaximumLength or strlen($password2) > $passwordMaximumLength)
    ) {
		array_push($passwordStrengthErrors, "Your password must be between 8 and 30 characters.");
	}

	if (!preg_match("#[0-9]+#", $password1) or !preg_match("#[0-9]+#", $password2)) {
		array_push($passwordStrengthErrors, "Your password must contain at least one number digit (ex: 0, 1, 2, 3, etc.).");
	}

	if (!preg_match("#[a-z]+#", $password1) or !preg_match("#[a-z]+#", $password2)) {
		array_push($passwordStrengthErrors, " Your password must contain at least one lowercase letter.");
	}

	if (!preg_match("#[A-Z]+#", $password1) or !preg_match("#[A-Z]+#", $password2)) {
		array_push($passwordStrengthErrors, "Your password must contain at least one uppercase, or capital, letter (ex: A, B, etc.).");
	}

	if (!preg_match("/[\'^£$%&*()}{@#~?><>,|=_+!-]/", $password1) or !preg_match("/[\'^£$%&*()}{@#~?><>,|=_+!-]/", $password2)) {
		array_push($passwordStrengthErrors, "Your password must contain at least one special character -for example: $, #, @, !,%,^,&,*,(,).");
	}

	return $passwordStrengthErrors;

}
?>
