<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int valid_since int valid_until long salt
 * @return FutureSalt
 */

final class FutureSalt extends Instance {
	public function request(int $valid_since,int $valid_until,int $salt) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x949d9dc);
		$writer->writeInt($valid_since);
		$writer->writeInt($valid_until);
		$writer->writeLong($salt);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['valid_since'] = $reader->readInt();
		$result['valid_until'] = $reader->readInt();
		$result['salt'] = $reader->readLong();
		return new self($result);
	}
}

?>