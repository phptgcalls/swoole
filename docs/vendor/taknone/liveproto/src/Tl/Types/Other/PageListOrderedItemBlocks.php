<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string num Vector<PageBlock> blocks
 * @return PageListOrderedItem
 */

final class PageListOrderedItemBlocks extends Instance {
	public function request(string $num,array $blocks) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x98dd8936);
		$writer->tgwriteBytes($num);
		$writer->tgwriteVector($blocks,'PageBlock');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['num'] = $reader->tgreadBytes();
		$result['blocks'] = $reader->tgreadVector('PageBlock');
		return new self($result);
	}
}

?>