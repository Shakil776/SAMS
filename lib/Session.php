<?php 
	/**
	 * Session class
	 */
	class Session {
		// session initialize
		public static function init() {
			if (version_compare(phpversion(), '5.4.0', '<')) {
				if (session_id() == '') {
					session_start();
				}
			} else {
				if (session_status() == PHP_SESSION_NONE) {
					session_start();
				}
			}
		}

		// set session
		public static function set($key, $value) {
			$_SESSION['$key'] = $value;
		}

		// get session
		public static function get() {
			if (isset($_SESSION['$key'])) {
				return $_SESSION['$key'];
			} else {
				return false;
			}
		}

		// unset session
		public static function unset(){
			session_unset();
		}

	}

 ?>