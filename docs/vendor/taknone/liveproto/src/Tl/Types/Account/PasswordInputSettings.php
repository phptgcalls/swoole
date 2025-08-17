<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param passwordkdfalgo new_algo bytes new_password_hash string hint string email securesecretsettings new_secure_settings
 * @return account.PasswordInputSettings
 */

final class PasswordInputSettings extends Instance {
	public function request(? object $new_algo = null,? string $new_password_hash = null,? string $hint = null,? string $email = null,? object $new_secure_settings = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc23727c9);
		$flags = 0;
		$flags |= is_null($new_algo) ? 0 : (1 << 0);
		$flags |= is_null($new_password_hash) ? 0 : (1 << 0);
		$flags |= is_null($hint) ? 0 : (1 << 0);
		$flags |= is_null($email) ? 0 : (1 << 1);
		$flags |= is_null($new_secure_settings) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		if(is_null($new_algo) === false):
			$writer->write($new_algo->read());
		endif;
		if(is_null($new_password_hash) === false):
			$writer->tgwriteBytes($new_password_hash);
		endif;
		if(is_null($hint) === false):
			$writer->tgwriteBytes($hint);
		endif;
		if(is_null($email) === false):
			$writer->tgwriteBytes($email);
		endif;
		if(is_null($new_secure_settings) === false):
			$writer->write($new_secure_settings->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['new_algo'] = $reader->tgreadObject();
		else:
			$result['new_algo'] = null;
		endif;
		if($flags & (1 << 0)):
			$result['new_password_hash'] = $reader->tgreadBytes();
		else:
			$result['new_password_hash'] = null;
		endif;
		if($flags & (1 << 0)):
			$result['hint'] = $reader->tgreadBytes();
		else:
			$result['hint'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['email'] = $reader->tgreadBytes();
		else:
			$result['email'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['new_secure_settings'] = $reader->tgreadObject();
		else:
			$result['new_secure_settings'] = null;
		endif;
		return new self($result);
	}
}

?>