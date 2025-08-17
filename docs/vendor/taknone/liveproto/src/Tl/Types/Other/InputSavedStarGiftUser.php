<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int msg_id
 * @return InputSavedStarGift
 */

final class InputSavedStarGiftUser extends Instance {
	public function request(int $msg_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x69279795);
		$writer->writeInt($msg_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['msg_id'] = $reader->readInt();
		return new self($result);
	}
}

?>