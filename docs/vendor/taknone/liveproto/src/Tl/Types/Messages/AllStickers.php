<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long hash Vector<StickerSet> sets
 * @return messages.AllStickers
 */

final class AllStickers extends Instance {
	public function request(int $hash,array $sets) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xcdbbcebb);
		$writer->writeLong($hash);
		$writer->tgwriteVector($sets,'StickerSet');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['hash'] = $reader->readLong();
		$result['sets'] = $reader->tgreadVector('StickerSet');
		return new self($result);
	}
}

?>