<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Auth;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param user user true setup_password_required int otherwise_relogin_days int tmp_sessions bytes future_auth_token
 * @return auth.Authorization
 */

final class Authorization extends Instance {
	public function request(object $user,? true $setup_password_required = null,? int $otherwise_relogin_days = null,? int $tmp_sessions = null,? string $future_auth_token = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x2ea2c0d4);
		$flags = 0;
		$flags |= is_null($setup_password_required) ? 0 : (1 << 1);
		$flags |= is_null($otherwise_relogin_days) ? 0 : (1 << 1);
		$flags |= is_null($tmp_sessions) ? 0 : (1 << 0);
		$flags |= is_null($future_auth_token) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		if(is_null($otherwise_relogin_days) === false):
			$writer->writeInt($otherwise_relogin_days);
		endif;
		if(is_null($tmp_sessions) === false):
			$writer->writeInt($tmp_sessions);
		endif;
		if(is_null($future_auth_token) === false):
			$writer->tgwriteBytes($future_auth_token);
		endif;
		$writer->write($user->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 1)):
			$result['setup_password_required'] = true;
		else:
			$result['setup_password_required'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['otherwise_relogin_days'] = $reader->readInt();
		else:
			$result['otherwise_relogin_days'] = null;
		endif;
		if($flags & (1 << 0)):
			$result['tmp_sessions'] = $reader->readInt();
		else:
			$result['tmp_sessions'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['future_auth_token'] = $reader->tgreadBytes();
		else:
			$result['future_auth_token'] = null;
		endif;
		$result['user'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>