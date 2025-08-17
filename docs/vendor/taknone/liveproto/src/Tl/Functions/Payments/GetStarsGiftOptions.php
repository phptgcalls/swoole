<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputuser user_id
 * @return Vector<StarsGiftOption>
 */

final class GetStarsGiftOptions extends Instance {
	public function request(? object $user_id = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xd3c96bc8);
		$flags = 0;
		$flags |= is_null($user_id) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		if(is_null($user_id) === false):
			$writer->write($user_id->read());
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