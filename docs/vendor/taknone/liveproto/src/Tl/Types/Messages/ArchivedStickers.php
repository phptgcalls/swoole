<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int count Vector<StickerSetCovered> sets
 * @return messages.ArchivedStickers
 */

final class ArchivedStickers extends Instance {
	public function request(int $count,array $sets) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x4fcba9c8);
		$writer->writeInt($count);
		$writer->tgwriteVector($sets,'StickerSetCovered');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['count'] = $reader->readInt();
		$result['sets'] = $reader->tgreadVector('StickerSetCovered');
		return new self($result);
	}
}

?>