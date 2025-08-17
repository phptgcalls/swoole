<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<string> codes
 * @return Bool
 */

final class InvalidateSignInCodes extends Instance {
	public function request(array $codes) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xca8ae8ba);
		$writer->tgwriteVector($codes,'string');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>