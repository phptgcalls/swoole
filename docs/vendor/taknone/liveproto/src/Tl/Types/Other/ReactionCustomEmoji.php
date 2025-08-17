<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long document_id
 * @return Reaction
 */

final class ReactionCustomEmoji extends Instance {
	public function request(int $document_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8935fc73);
		$writer->writeLong($document_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['document_id'] = $reader->readLong();
		return new self($result);
	}
}

?>