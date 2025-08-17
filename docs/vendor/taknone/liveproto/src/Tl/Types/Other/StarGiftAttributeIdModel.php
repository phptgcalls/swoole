<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long document_id
 * @return StarGiftAttributeId
 */

final class StarGiftAttributeIdModel extends Instance {
	public function request(int $document_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x48aaae3c);
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