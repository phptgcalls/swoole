<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long id
 * @return InputWallPaper
 */

final class InputWallPaperNoFile extends Instance {
	public function request(int $id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x967a462e);
		$writer->writeLong($id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['id'] = $reader->readLong();
		return new self($result);
	}
}

?>