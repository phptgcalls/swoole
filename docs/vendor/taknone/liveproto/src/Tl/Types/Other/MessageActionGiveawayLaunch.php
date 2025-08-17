<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long stars
 * @return MessageAction
 */

final class MessageActionGiveawayLaunch extends Instance {
	public function request(? int $stars = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa80f51e4);
		$flags = 0;
		$flags |= is_null($stars) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		if(is_null($stars) === false):
			$writer->writeLong($stars);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['stars'] = $reader->readLong();
		else:
			$result['stars'] = null;
		endif;
		return new self($result);
	}
}

?>