<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Contacts;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<string> phones
 * @return Bool
 */

final class DeleteByPhones extends Instance {
	public function request(array $phones) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x1013fd9e);
		$writer->tgwriteVector($phones,'string');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>