<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer Vector<int> order
 * @return Bool
 */

final class ReorderStarGiftCollections extends Instance {
	public function request(object $peer,array $order) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc32af4cc);
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