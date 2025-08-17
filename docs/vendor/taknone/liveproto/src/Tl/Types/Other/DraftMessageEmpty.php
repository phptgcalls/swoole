<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int date
 * @return DraftMessage
 */

final class DraftMessageEmpty extends Instance {
	public function request(? int $date = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x1b0c841a);
		$flags = 0;
		$flags |= is_null($date) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		if(is_null($date) === false):
			$writer->writeInt($date);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['date'] = $reader->readInt();
		else:
			$result['date'] = null;
		endif;
		return new self($result);
	}
}

?>