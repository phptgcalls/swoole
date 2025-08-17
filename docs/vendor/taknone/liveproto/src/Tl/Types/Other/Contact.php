<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long user_id bool mutual
 * @return Contact
 */

final class Contact extends Instance {
	public function request(int $user_id,bool $mutual) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x145ade0b);
		$writer->writeLong($user_id);
		$writer->tgwriteBool($mutual);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['user_id'] = $reader->readLong();
		$result['mutual'] = $reader->tgreadBool();
		return new self($result);
	}
}

?>