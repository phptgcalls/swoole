<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string text Vector<MessageEntity> entities
 * @return TextWithEntities
 */

final class TextWithEntities extends Instance {
	public function request(string $text,array $entities) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x751f3146);
		$writer->tgwriteBytes($text);
		$writer->tgwriteVector($entities,'MessageEntity');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['text'] = $reader->tgreadBytes();
		$result['entities'] = $reader->tgreadVector('MessageEntity');
		return new self($result);
	}
}

?>