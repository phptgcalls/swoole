<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Phone;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputphonecall peer bytes data
 * @return Bool
 */

final class SendSignalingData extends Instance {
	public function request(object $peer,string $data) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xff7a9383);
		$writer->write($peer->read());
		$writer->tgwriteBytes($data);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>