<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param securevaluetype type bytes file_hash string text
 * @return SecureValueError
 */

final class SecureValueErrorTranslationFile extends Instance {
	public function request(object $type,string $file_hash,string $text) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa1144770);
		$writer->write($type->read());
		$writer->tgwriteBytes($file_hash);
		$writer->tgwriteBytes($text);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['type'] = $reader->tgreadObject();
		$result['file_hash'] = $reader->tgreadBytes();
		$result['text'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>