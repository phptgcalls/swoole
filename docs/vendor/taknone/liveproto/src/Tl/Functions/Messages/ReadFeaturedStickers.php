<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<long> id
 * @return Bool
 */

final class ReadFeaturedStickers extends Instance {
	public function request(array $id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x5b118126);
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