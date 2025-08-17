<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int collection_id
 * @return Bool
 */

final class DeleteStarGiftCollection extends Instance {
	public function request(object $peer,int $collection_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xad5648e8);
		$writer->write($peer->read());
		$writer->writeInt($collection_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>