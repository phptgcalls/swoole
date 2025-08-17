<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long user_id int invitations
 * @return StatsGroupTopInviter
 */

final class StatsGroupTopInviter extends Instance {
	public function request(int $user_id,int $invitations) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x535f779d);
		$writer->writeLong($user_id);
		$writer->writeInt($invitations);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['user_id'] = $reader->readLong();
		$result['invitations'] = $reader->readInt();
		return new self($result);
	}
}

?>