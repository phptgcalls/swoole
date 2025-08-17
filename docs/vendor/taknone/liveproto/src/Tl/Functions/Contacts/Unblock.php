<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Contacts;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer id true my_stories_from
 * @return Bool
 */

final class Unblock extends Instance {
	public function request(object $id,? true $my_stories_from = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb550d328);
		$flags = 0;
		$flags |= is_null($my_stories_from) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($id->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>