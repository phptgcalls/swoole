<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string text bytes data true requires_password
 * @return KeyboardButton
 */

final class KeyboardButtonCallback extends Instance {
	public function request(string $text,string $data,? true $requires_password = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x35bbdb6b);
		$flags = 0;
		$flags |= is_null($requires_password) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($text);
		$writer->tgwriteBytes($data);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['requires_password'] = true;
		else:
			$result['requires_password'] = false;
		endif;
		$result['text'] = $reader->tgreadBytes();
		$result['data'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>