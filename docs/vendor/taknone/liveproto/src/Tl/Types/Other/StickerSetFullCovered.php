<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param stickerset set Vector<StickerPack> packs Vector<StickerKeyword> keywords Vector<Document> documents
 * @return StickerSetCovered
 */

final class StickerSetFullCovered extends Instance {
	public function request(object $set,array $packs,array $keywords,array $documents) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x40d13c0e);
		$writer->write($set->read());
		$writer->tgwriteVector($packs,'StickerPack');
		$writer->tgwriteVector($keywords,'StickerKeyword');
		$writer->tgwriteVector($documents,'Document');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['set'] = $reader->tgreadObject();
		$result['packs'] = $reader->tgreadVector('StickerPack');
		$result['keywords'] = $reader->tgreadVector('StickerKeyword');
		$result['documents'] = $reader->tgreadVector('Document');
		return new self($result);
	}
}

?>