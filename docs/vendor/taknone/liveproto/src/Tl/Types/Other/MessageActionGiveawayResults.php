<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int winners_count int unclaimed_count true stars
 * @return MessageAction
 */

final class MessageActionGiveawayResults extends Instance {
	public function request(int $winners_count,int $unclaimed_count,? true $stars = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x87e2f155);
		$flags = 0;
		$flags |= is_null($stars) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeInt($winners_count);
		$writer->writeInt($unclaimed_count);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['stars'] = true;
		else:
			$result['stars'] = false;
		endif;
		$result['winners_count'] = $reader->readInt();
		$result['unclaimed_count'] = $reader->readInt();
		return new self($result);
	}
}

?>