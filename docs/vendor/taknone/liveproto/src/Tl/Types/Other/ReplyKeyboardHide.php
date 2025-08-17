<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param true selective
 * @return ReplyMarkup
 */

final class ReplyKeyboardHide extends Instance {
	public function request(? true $selective = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa03e5b85);
		$flags = 0;
		$flags |= is_null($selective) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 2)):
			$result['selective'] = true;
		else:
			$result['selective'] = false;
		endif;
		return new self($result);
	}
}

?>