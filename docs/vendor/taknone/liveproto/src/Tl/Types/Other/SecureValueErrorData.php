<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param securevaluetype type bytes data_hash string field string text
 * @return SecureValueError
 */

final class SecureValueErrorData extends Instance {
	public function request(object $type,string $data_hash,string $field,string $text) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe8a40bd9);
		$writer->write($type->read());
		$writer->tgwriteBytes($data_hash);
		$writer->tgwriteBytes($field);
		$writer->tgwriteBytes($text);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['type'] = $reader->tgreadObject();
		$result['data_hash'] = $reader->tgreadBytes();
		$result['field'] = $reader->tgreadBytes();
		$result['text'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>