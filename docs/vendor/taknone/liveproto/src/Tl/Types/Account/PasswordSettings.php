<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string email securesecretsettings secure_settings
 * @return account.PasswordSettings
 */

final class PasswordSettings extends Instance {
	public function request(? string $email = null,? object $secure_settings = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x9a5c33e5);
		$flags = 0;
		$flags |= is_null($email) ? 0 : (1 << 0);
		$flags |= is_null($secure_settings) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		if(is_null($email) === false):
			$writer->tgwriteBytes($email);
		endif;
		if(is_null($secure_settings) === false):
			$writer->write($secure_settings->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['email'] = $reader->tgreadBytes();
		else:
			$result['email'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['secure_settings'] = $reader->tgreadObject();
		else:
			$result['secure_settings'] = null;
		endif;
		return new self($result);
	}
}

?>