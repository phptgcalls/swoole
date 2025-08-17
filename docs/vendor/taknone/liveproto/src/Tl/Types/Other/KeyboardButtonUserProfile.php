<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string text long user_id
 * @return KeyboardButton
 */

final class KeyboardButtonUserProfile extends Instance {
	public function request(string $text,int $user_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x308660c1);
		$writer->tgwriteBytes($text);
		$writer->writeLong($user_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['text'] = $reader->tgreadBytes();
		$result['user_id'] = $reader->readLong();
		return new self($result);
	}
}

?>