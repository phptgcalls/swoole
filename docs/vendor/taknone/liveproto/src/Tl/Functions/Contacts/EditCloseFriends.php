<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Contacts;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<long> id
 * @return Bool
 */

final class EditCloseFriends extends Instance {
	public function request(array $id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xba6705f0);
		$writer->tgwriteVector($id,'long');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>