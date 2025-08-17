<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param auth sent_code
 * @return Update
 */

final class UpdateSentPhoneCode extends Instance {
	public function request(object $sent_code) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x504aa18f);
		$writer->write($sent_code->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['sent_code'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>