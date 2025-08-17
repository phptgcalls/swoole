<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param dialogfilter filter string description
 * @return DialogFilterSuggested
 */

final class DialogFilterSuggested extends Instance {
	public function request(object $filter,string $description) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x77744d4a);
		$writer->write($filter->read());
		$writer->tgwriteBytes($description);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['filter'] = $reader->tgreadObject();
		$result['description'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>