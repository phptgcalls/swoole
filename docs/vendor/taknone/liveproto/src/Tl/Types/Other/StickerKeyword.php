<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long document_id Vector<string> keyword
 * @return StickerKeyword
 */

final class StickerKeyword extends Instance {
	public function request(int $document_id,array $keyword) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xfcfeb29c);
		$writer->writeLong($document_id);
		$writer->tgwriteVector($keyword,'string');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['document_id'] = $reader->readLong();
		$result['keyword'] = $reader->tgreadVector('string');
		return new self($result);
	}
}

?>