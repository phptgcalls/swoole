<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Auth;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param help terms_of_service
 * @return auth.Authorization
 */

final class AuthorizationSignUpRequired extends Instance {
	public function request(? object $terms_of_service = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x44747e9a);
		$flags = 0;
		$flags |= is_null($terms_of_service) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		if(is_null($terms_of_service) === false):
			$writer->write($terms_of_service->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['terms_of_service'] = $reader->tgreadObject();
		else:
			$result['terms_of_service'] = null;
		endif;
		return new self($result);
	}
}

?>