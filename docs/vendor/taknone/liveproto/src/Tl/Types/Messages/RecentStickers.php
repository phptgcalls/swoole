<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long hash Vector<StickerPack> packs Vector<Document> stickers Vector<int> dates
 * @return messages.RecentStickers
 */

final class RecentStickers extends Instance {
	public function request(int $hash,array $packs,array $stickers,array $dates) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x88d37c56);
		$writer->writeLong($hash);
		$writer->tgwriteVector($packs,'StickerPack');
		$writer->tgwriteVector($stickers,'Document');
		$writer->tgwriteVector($dates,'int');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['hash'] = $reader->readLong();
		$result['packs'] = $reader->tgreadVector('StickerPack');
		$result['stickers'] = $reader->tgreadVector('Document');
		$result['dates'] = $reader->tgreadVector('int');
		return new self($result);
	}
}

?>