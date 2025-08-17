<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<PageListOrderedItem> items
 * @return PageBlock
 */

final class PageBlockOrderedList extends Instance {
	public function request(array $items) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x9a8ae1e1);
		$writer->tgwriteVector($items,'PageListOrderedItem');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['items'] = $reader->tgreadVector('PageListOrderedItem');
		return new self($result);
	}
}

?>