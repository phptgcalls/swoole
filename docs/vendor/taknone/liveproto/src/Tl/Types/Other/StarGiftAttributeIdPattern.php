<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long document_id
 * @return StarGiftAttributeId
 */

final class StarGiftAttributeIdPattern extends Instance {
	public function request(int $document_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x4a162433);
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