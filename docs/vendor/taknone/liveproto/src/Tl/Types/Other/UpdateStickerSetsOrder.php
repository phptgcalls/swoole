<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<long> order true masks true emojis
 * @return Update
 */

final class UpdateStickerSetsOrder extends Instance {
	public function request(array $order,? true $masks = null,? true $emojis = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xbb2d201);
		$flags = 0;
		$flags |= is_null($masks) ? 0 : (1 << 0);
		$flags |= is_null($emojis) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->tgwriteVector($order,'long');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['masks'] = true;
		else:
			$result['masks'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['emojis'] = true;
		else:
			$result['emojis'] = false;
		endif;
		$result['order'] = $reader->tgreadVector('long');
		return new self($result);
	}
}

?>