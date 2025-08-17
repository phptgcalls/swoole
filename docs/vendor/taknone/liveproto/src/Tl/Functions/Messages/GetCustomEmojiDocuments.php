<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<long> document_id
 * @return Vector<Document>
 */

final class GetCustomEmojiDocuments extends Instance {
	public function request(array $document_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xd9ab0f54);
		$writer->tgwriteVector($document_id,'long');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>