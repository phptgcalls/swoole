<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param birthday birthday
 * @return Bool
 */

final class UpdateBirthday extends Instance {
	public function request(? object $birthday = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xcc6e0c11);
		$flags = 0;
		$flags |= is_null($birthday) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		if(is_null($birthday) === false):
			$writer->write($birthday->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>