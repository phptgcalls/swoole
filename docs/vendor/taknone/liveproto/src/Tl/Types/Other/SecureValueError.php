<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param securevaluetype type bytes hash string text
 * @return SecureValueError
 */

final class SecureValueError extends Instance {
	public function request(object $type,string $hash,string $text) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x869d758f);
		$writer->write($type->read());
		$writer->tgwriteBytes($hash);
		$writer->tgwriteBytes($text);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['type'] = $reader->tgreadObject();
		$result['hash'] = $reader->tgreadBytes();
		$result['text'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>