<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long user_id string phone
 * @return Update
 */

final class UpdateUserPhone extends Instance {
	public function request(int $user_id,string $phone) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x5492a13);
		$writer->writeLong($user_id);
		$writer->tgwriteBytes($phone);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['user_id'] = $reader->readLong();
		$result['phone'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>