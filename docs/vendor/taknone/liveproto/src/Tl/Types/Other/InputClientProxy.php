<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string address int port
 * @return InputClientProxy
 */

final class InputClientProxy extends Instance {
	public function request(string $address,int $port) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x75588b3f);
		$writer->tgwriteBytes($address);
		$writer->writeInt($port);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['address'] = $reader->tgreadBytes();
		$result['port'] = $reader->readInt();
		return new self($result);
	}
}

?>