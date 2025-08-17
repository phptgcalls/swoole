<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<PageTableCell> cells
 * @return PageTableRow
 */

final class PageTableRow extends Instance {
	public function request(array $cells) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe0c0c5e5);
		$writer->tgwriteVector($cells,'PageTableCell');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['cells'] = $reader->tgreadVector('PageTableCell');
		return new self($result);
	}
}

?>