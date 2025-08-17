<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Stories;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer Vector<int> id bool pinned
 * @return Vector<int>
 */

final class TogglePinned extends Instance {
	public function request(object $peer,array $id,bool $pinned) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x9a75a1ef);
		$writer->write($peer->read());
		$writer->tgwriteVector($id,'int');
		$writer->tgwriteBool($pinned);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>