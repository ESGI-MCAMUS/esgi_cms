<?php

namespace App\Core;

use App\Core\Helpers;

class FormValidator {



	public static function check($data, $nbParameters) {

		$errors = [];

		if (count($data) != $nbParameters) {
			array_push($errors, 'xss_breach');
		} else {

			$data['firstname'] = Helpers::cleanName($data['firstname']);
			$data['lastname'] = Helpers::cleanName($data['lastname']);
			$data['focus_element_country'] = Helpers::cleanCountry($data['focus_element_country']);

			if (strcmp($data['pwd1'], $data['pwd2']) != 0) {
				array_push($errors, 'password_mismatching');
			} else {
				$pattern = '/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,128}$/';
				if (preg_match($pattern, ($data['pwd1'])) != 1) {
					array_push($errors, 'password_does_not_fit');
				}
			}

			if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
				array_push($errors, 'invalid_email_pattern');
			}
		}

		return $errors;
	}

	public static function checkUpdateUser($data) {
		$errors = [];

		if (isset($data["email"]) && strlen($data["email"]) > 0) {
			$data['email'] = Helpers::cleanMail($data['email']);

			if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
				array_push($errors, 'invalid_email_pattern');
			}
		}

		if (strlen($data['pwd2']) != 0 && strlen($data['pwd3']) != 0) {
			if (strcmp($data['pwd1'], $data['pwd2']) == 0) {
				array_push($errors, 'password_cant_match');
			} else {

				if (strcmp($data['pwd2'], $data['pwd3']) != 0) {
					array_push($errors, 'password_mismatching');
				} else {
					$pattern = '/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,128}$/';
					if (preg_match($pattern, ($data['pwd2'])) != 1) {
						array_push($errors, 'password_does_not_fit');
					}
				}
			}
		}

		return $errors;
	}

	public static function checkPasswordFitAndMatch($pwd1, $pwd2) {
		$errors = [];
		if (strcmp($pwd1, $pwd2) != 0) {
			array_push($errors, 'password_mismatching');
		} else {
			$pattern = '/^(?=.*[!@#$%^&*-])(?=.*[0-9])(?=.*[A-Z]).{8,128}$/';
			if (preg_match($pattern, ($pwd1)) != 1) {
				array_push($errors, 'password_does_not_fit');
			}
		}

		return $errors;
	}
}
