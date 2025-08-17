<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Help;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string phone_number user user
 * @return help.Support
 */

final class Support extends Instance {
	public function request(string $phone_number,object $user) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x17c6b5f6);
		$writer->tgwriteBytes($phone_number);
		$writer->write($user->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['phone_number'] = $reader->tgreadBytes();
		$result['user'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>