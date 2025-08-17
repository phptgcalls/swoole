<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param true accepted true rejected starsamount price int schedule_date
 * @return SuggestedPost
 */

final class SuggestedPost extends Instance {
	public function request(? true $accepted = null,? true $rejected = null,? object $price = null,? int $schedule_date = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe8e37e5);
		$flags = 0;
		$flags |= is_null($accepted) ? 0 : (1 << 1);
		$flags |= is_null($rejected) ? 0 : (1 << 2);
		$flags |= is_null($price) ? 0 : (1 << 3);
		$flags |= is_null($schedule_date) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		if(is_null($price) === false):
			$writer->write($price->read());
		endif;
		if(is_null($schedule_date) === false):
			$writer->writeInt($schedule_date);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 1)):
			$result['accepted'] = true;
		else:
			$result['accepted'] = false;
		endif;
		if($flags & (1 << 2)):
			$result['rejected'] = true;
		else:
			$result['rejected'] = false;
		endif;
		if($flags & (1 << 3)):
			$result['price'] = $reader->tgreadObject();
		else:
			$result['price'] = null;
		endif;
		if($flags & (1 << 0)):
			$result['schedule_date'] = $reader->readInt();
		else:
			$result['schedule_date'] = null;
		endif;
		return new self($result);
	}
}

?>