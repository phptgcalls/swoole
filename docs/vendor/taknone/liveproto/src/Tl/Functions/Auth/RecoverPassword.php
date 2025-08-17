<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Auth;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string code account new_settings
 * @return auth.Authorization
 */

final class RecoverPassword extends Instance {
	public function request(string $code,? object $new_settings = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x37096c70);
		$flags = 0;
		$flags |= is_null($new_settings) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($code);
		if(is_null($new_settings) === false):
			$writer->write($new_settings->read());
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