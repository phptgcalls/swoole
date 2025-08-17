<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int g bytes p int version bytes random
 * @return messages.DhConfig
 */

final class DhConfig extends Instance {
	public function request(int $g,string $p,int $version,string $random) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x2c221edd);
		$writer->writeInt($g);
		$writer->tgwriteBytes($p);
		$writer->writeInt($version);
		$writer->tgwriteBytes($random);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['g'] = $reader->readInt();
		$result['p'] = $reader->tgreadBytes();
		$result['version'] = $reader->readInt();
		$result['random'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>