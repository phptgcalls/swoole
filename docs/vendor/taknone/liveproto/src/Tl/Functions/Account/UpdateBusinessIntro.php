<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputbusinessintro intro
 * @return Bool
 */

final class UpdateBusinessIntro extends Instance {
	public function request(? object $intro = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa614d034);
		$flags = 0;
		$flags |= is_null($intro) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		if(is_null($intro) === false):
			$writer->write($intro->read());
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