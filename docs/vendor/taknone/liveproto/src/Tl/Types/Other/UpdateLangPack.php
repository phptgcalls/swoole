<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param langpackdifference difference
 * @return Update
 */

final class UpdateLangPack extends Instance {
	public function request(object $difference) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x56022f4d);
		$writer->write($difference->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['difference'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>