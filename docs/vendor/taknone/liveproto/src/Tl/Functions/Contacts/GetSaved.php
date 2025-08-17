<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Contacts;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param 
 * @return Vector<SavedContact>
 */

final class GetSaved extends Instance {
	public function request() : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x82f1e39f);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>