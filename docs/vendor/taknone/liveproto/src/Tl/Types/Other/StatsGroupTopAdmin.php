<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long user_id int deleted int kicked int banned
 * @return StatsGroupTopAdmin
 */

final class StatsGroupTopAdmin extends Instance {
	public function request(int $user_id,int $deleted,int $kicked,int $banned) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xd7584c87);
		$writer->writeLong($user_id);
		$writer->writeInt($deleted);
		$writer->writeInt($kicked);
		$writer->writeInt($banned);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['user_id'] = $reader->readLong();
		$result['deleted'] = $reader->readInt();
		$result['kicked'] = $reader->readInt();
		$result['banned'] = $reader->readInt();
		return new self($result);
	}
}

?>