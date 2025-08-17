<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string text inputuser user_id
 * @return KeyboardButton
 */

final class InputKeyboardButtonUserProfile extends Instance {
	public function request(string $text,object $user_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe988037b);
		$writer->tgwriteBytes($text);
		$writer->write($user_id->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['text'] = $reader->tgreadBytes();
		$result['user_id'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>