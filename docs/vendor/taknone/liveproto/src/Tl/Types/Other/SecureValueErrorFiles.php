<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param securevaluetype type Vector<bytes> file_hash string text
 * @return SecureValueError
 */

final class SecureValueErrorFiles extends Instance {
	public function request(object $type,array $file_hash,string $text) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x666220e9);
		$writer->write($type->read());
		$writer->tgwriteVector($file_hash,'bytes');
		$writer->tgwriteBytes($text);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['type'] = $reader->tgreadObject();
		$result['file_hash'] = $reader->tgreadVector('bytes');
		$result['text'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>