<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Secret;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int w int h
 * @return secret.DocumentAttribute
 */

final class DocumentAttributeImageSize extends Instance {
	public function request(int $w,int $h) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x6c37c15c);
		$writer->writeInt($w);
		$writer->writeInt($h);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['w'] = $reader->readInt();
		$result['h'] = $reader->readInt();
		return new self($result);
	}
}

?>