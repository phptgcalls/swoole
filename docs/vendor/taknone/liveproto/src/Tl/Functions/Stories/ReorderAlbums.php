<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Stories;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer Vector<int> order
 * @return Bool
 */

final class ReorderAlbums extends Instance {
	public function request(object $peer,array $order) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8535fbd9);
		$writer->write($peer->read());
		$writer->tgwriteVector($order,'int');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>