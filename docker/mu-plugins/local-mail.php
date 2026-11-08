<?php
/**
 * Local development only: deliver all mail to Mailpit.
 *
 * WordPress sends from wordpress@<site host>; on localhost that address has no dot and
 * PHPMailer refuses it, so a local sender with a dot in its host is used instead.
 *
 * @package OsousWebflow
 */

add_filter(
	'wp_mail_from',
	static function (): string {
		return 'wordpress@osous.test';
	}
);

add_action(
	'phpmailer_init',
	static function ( $phpmailer ): void {
		$phpmailer->isSMTP();
		$phpmailer->Host     = 'mail';
		$phpmailer->Port     = 1025;
		$phpmailer->SMTPAuth = false;
	}
);
