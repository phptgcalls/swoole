<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long hash Vector<StickerSetCovered> sets
 * @return messages.FoundStickerSets
 */

final class FoundStickerSets extends Instance {
	public function request(int $hash,array $sets) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8af09dd2);
		$writer->writeLong($hash);
		$writer->tgwriteVector($sets,'StickerSetCovered');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['hash'] = $reader->readLong();
		$result['sets'] = $reader->tgreadVector('StickerSetCovered');
		return new self($result);
	}
}

?>