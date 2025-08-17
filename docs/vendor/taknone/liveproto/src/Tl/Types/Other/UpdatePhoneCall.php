<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param phonecall phone_call
 * @return Update
 */

final class UpdatePhoneCall extends Instance {
	public function request(object $phone_call) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xab0f6b1e);
		$writer->write($phone_call->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['phone_call'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>