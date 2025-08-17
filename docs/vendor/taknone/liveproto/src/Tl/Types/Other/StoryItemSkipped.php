<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int id int date int expire_date true close_friends
 * @return StoryItem
 */

final class StoryItemSkipped extends Instance {
	public function request(int $id,int $date,int $expire_date,? true $close_friends = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xffadc913);
		$flags = 0;
		$flags |= is_null($close_friends) ? 0 : (1 << 8);
		$writer->writeInt($flags);
		$writer->writeInt($id);
		$writer->writeInt($date);
		$writer->writeInt($expire_date);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 8)):
			$result['close_friends'] = true;
		else:
			$result['close_friends'] = false;
		endif;
		$result['id'] = $reader->readInt();
		$result['date'] = $reader->readInt();
		$result['expire_date'] = $reader->readInt();
		return new self($result);
	}
}

?>