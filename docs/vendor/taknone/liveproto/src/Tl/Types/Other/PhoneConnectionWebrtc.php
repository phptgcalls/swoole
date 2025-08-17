<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long id string ip string ipv6 int port string username string password true turn true stun
 * @return PhoneConnection
 */

final class PhoneConnectionWebrtc extends Instance {
	public function request(int $id,string $ip,string $ipv6,int $port,string $username,string $password,? true $turn = null,? true $stun = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x635fe375);
		$flags = 0;
		$flags |= is_null($turn) ? 0 : (1 << 0);
		$flags |= is_null($stun) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->writeLong($id);
		$writer->tgwriteBytes($ip);
		$writer->tgwriteBytes($ipv6);
		$writer->writeInt($port);
		$writer->tgwriteBytes($username);
		$writer->tgwriteBytes($password);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['turn'] = true;
		else:
			$result['turn'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['stun'] = true;
		else:
			$result['stun'] = false;
		endif;
		$result['id'] = $reader->readLong();
		$result['ip'] = $reader->tgreadBytes();
		$result['ipv6'] = $reader->tgreadBytes();
		$result['port'] = $reader->readInt();
		$result['username'] = $reader->tgreadBytes();
		$result['password'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>