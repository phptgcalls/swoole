<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int ipv4 int port
 * @return IpPort
 */

final class IpPort extends Instance {
	public function request(int $ipv4,int $port) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xd433ad73);
		$writer->writeInt($ipv4);
		$writer->writeInt($port);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['ipv4'] = $reader->readInt();
		$result['port'] = $reader->readInt();
		return new self($result);
	}
}

?>