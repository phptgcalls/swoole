<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Secret;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string alt inputstickerset stickerset
 * @return secret.DocumentAttribute
 */

final class DocumentAttributeSticker extends Instance {
	public function request(string $alt,object $stickerset) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x3a556302);
		$writer->tgwriteBytes($alt);
		$writer->write($stickerset->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['alt'] = $reader->tgreadBytes();
		$result['stickerset'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>