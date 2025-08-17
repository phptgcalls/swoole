<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int users long per_user_stars true default
 * @return StarsGiveawayWinnersOption
 */

final class StarsGiveawayWinnersOption extends Instance {
	public function request(int $users,int $per_user_stars,? true $default = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x54236209);
		$flags = 0;
		$flags |= is_null($default) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeInt($users);
		$writer->writeLong($per_user_stars);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['default'] = true;
		else:
			$result['default'] = false;
		endif;
		$result['users'] = $reader->readInt();
		$result['per_user_stars'] = $reader->readLong();
		return new self($result);
	}
}

?>