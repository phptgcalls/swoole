<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param richtext title Vector<PageTableRow> rows true bordered true striped
 * @return PageBlock
 */

final class PageBlockTable extends Instance {
	public function request(object $title,array $rows,? true $bordered = null,? true $striped = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xbf4dea82);
		$flags = 0;
		$flags |= is_null($bordered) ? 0 : (1 << 0);
		$flags |= is_null($striped) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->write($title->read());
		$writer->tgwriteVector($rows,'PageTableRow');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['bordered'] = true;
		else:
			$result['bordered'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['striped'] = true;
		else:
			$result['striped'] = false;
		endif;
		$result['title'] = $reader->tgreadObject();
		$result['rows'] = $reader->tgreadVector('PageTableRow');
		return new self($result);
	}
}

?>