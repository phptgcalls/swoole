<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Contacts;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param toppeercategory category inputpeer peer
 * @return Bool
 */

final class ResetTopPeerRating extends Instance {
	public function request(object $category,object $peer) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x1ae373ac);
		$writer->write($category->read());
		$writer->write($peer->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>