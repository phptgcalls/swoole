<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long hash Vector<long> document_id
 * @return EmojiList
 */

final class EmojiList extends Instance {
	public function request(int $hash,array $document_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x7a1e11d1);
		$writer->writeLong($hash);
		$writer->tgwriteVector($document_id,'long');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['hash'] = $reader->readLong();
		$result['document_id'] = $reader->tgreadVector('long');
		return new self($result);
	}
}

?>