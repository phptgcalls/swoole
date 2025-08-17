<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long id string ip string ipv6 int port bytes peer_tag true tcp
 * @return PhoneConnection
 */

final class PhoneConnection extends Instance {
	public function request(int $id,string $ip,string $ipv6,int $port,string $peer_tag,? true $tcp = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x9cc123c7);
		$flags = 0;
		$flags |= is_null($tcp) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeLong($id);
		$writer->tgwriteBytes($ip);
		$writer->tgwriteBytes($ipv6);
		$writer->writeInt($port);
		$writer->tgwriteBytes($peer_tag);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['tcp'] = true;
		else:
			$result['tcp'] = false;
		endif;
		$result['id'] = $reader->readLong();
		$result['ip'] = $reader->tgreadBytes();
		$result['ipv6'] = $reader->tgreadBytes();
		$result['port'] = $reader->readInt();
		$result['peer_tag'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>