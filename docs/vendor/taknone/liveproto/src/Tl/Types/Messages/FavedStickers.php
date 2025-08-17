<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long hash Vector<StickerPack> packs Vector<Document> stickers
 * @return messages.FavedStickers
 */

final class FavedStickers extends Instance {
	public function request(int $hash,array $packs,array $stickers) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x2cb51097);
		$writer->writeLong($hash);
		$writer->tgwriteVector($packs,'StickerPack');
		$writer->tgwriteVector($stickers,'Document');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['hash'] = $reader->readLong();
		$result['packs'] = $reader->tgreadVector('StickerPack');
		$result['stickers'] = $reader->tgreadVector('Document');
		return new self($result);
	}
}

?>