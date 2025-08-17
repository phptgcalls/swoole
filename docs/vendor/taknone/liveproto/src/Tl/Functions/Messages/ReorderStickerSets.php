<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<long> order true masks true emojis
 * @return Bool
 */

final class ReorderStickerSets extends Instance {
	public function request(array $order,? true $masks = null,? true $emojis = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x78337739);
		$flags = 0;
		$flags |= is_null($masks) ? 0 : (1 << 0);
		$flags |= is_null($emojis) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->tgwriteVector($order,'long');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>