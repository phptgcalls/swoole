<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long stickerset true masks true emojis
 * @return Update
 */

final class UpdateMoveStickerSetToTop extends Instance {
	public function request(int $stickerset,? true $masks = null,? true $emojis = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x86fccf85);
		$flags = 0;
		$flags |= is_null($masks) ? 0 : (1 << 0);
		$flags |= is_null($emojis) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->writeLong($stickerset);
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
		$result['stickerset'] = $reader->readLong();
		return new self($result);
	}
}

?>