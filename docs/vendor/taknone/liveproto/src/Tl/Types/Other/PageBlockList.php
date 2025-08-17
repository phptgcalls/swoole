<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<PageListItem> items
 * @return PageBlock
 */

final class PageBlockList extends Instance {
	public function request(array $items) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe4e88011);
		$writer->tgwriteVector($items,'PageListItem');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['items'] = $reader->tgreadVector('PageListItem');
		return new self($result);
	}
}

?>