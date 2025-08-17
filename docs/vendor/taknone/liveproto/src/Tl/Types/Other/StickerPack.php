<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string emoticon Vector<long> documents
 * @return StickerPack
 */

final class StickerPack extends Instance {
	public function request(string $emoticon,array $documents) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x12b299d4);
		$writer->tgwriteBytes($emoticon);
		$writer->tgwriteVector($documents,'long');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['emoticon'] = $reader->tgreadBytes();
		$result['documents'] = $reader->tgreadVector('long');
		return new self($result);
	}
}

?>