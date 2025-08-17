<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Auth;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param true apple_signin_allowed true google_signin_allowed
 * @return auth.SentCodeType
 */

final class SentCodeTypeSetUpEmailRequired extends Instance {
	public function request(? true $apple_signin_allowed = null,? true $google_signin_allowed = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa5491dea);
		$flags = 0;
		$flags |= is_null($apple_signin_allowed) ? 0 : (1 << 0);
		$flags |= is_null($google_signin_allowed) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['apple_signin_allowed'] = true;
		else:
			$result['apple_signin_allowed'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['google_signin_allowed'] = true;
		else:
			$result['google_signin_allowed'] = false;
		endif;
		return new self($result);
	}
}

?>