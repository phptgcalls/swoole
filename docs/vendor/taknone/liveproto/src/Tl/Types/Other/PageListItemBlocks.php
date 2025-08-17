<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<PageBlock> blocks
 * @return PageListItem
 */

final class PageListItemBlocks extends Instance {
	public function request(array $blocks) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x25e073fc);
		$writer->tgwriteVector($blocks,'PageBlock');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['blocks'] = $reader->tgreadVector('PageBlock');
		return new self($result);
	}
}

?>