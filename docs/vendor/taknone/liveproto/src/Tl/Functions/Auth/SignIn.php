<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Auth;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string phone_number string phone_code_hash string phone_code emailverification email_verification
 * @return auth.Authorization
 */

final class SignIn extends Instance {
	public function request(string $phone_number,string $phone_code_hash,? string $phone_code = null,? object $email_verification = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8d52a951);
		$flags = 0;
		$flags |= is_null($phone_code) ? 0 : (1 << 0);
		$flags |= is_null($email_verification) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($phone_number);
		$writer->tgwriteBytes($phone_code_hash);
		if(is_null($phone_code) === false):
			$writer->tgwriteBytes($phone_code);
		endif;
		if(is_null($email_verification) === false):
			$writer->write($email_verification->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>