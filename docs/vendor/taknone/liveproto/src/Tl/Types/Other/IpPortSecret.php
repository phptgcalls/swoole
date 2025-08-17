<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int ipv4 int port bytes secret
 * @return IpPort
 */

final class IpPortSecret extends Instance {
	public function request(int $ipv4,int $port,string $secret) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x37982646);
		$writer->writeInt($ipv4);
		$writer->writeInt($port);
		$writer->tgwriteBytes($secret);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['ipv4'] = $reader->readInt();
		$result['port'] = $reader->readInt();
		$result['secret'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>