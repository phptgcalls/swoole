<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int code string text
 * @return Error
 */

final class ErrorObject extends Instance {
	public function request(int $code,string $text) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc4b9f9bb);
		$writer->writeInt($code);
		$writer->tgwriteBytes($text);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['code'] = $reader->readInt();
		$result['text'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>