<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<PageBlock> items pagecaption caption
 * @return PageBlock
 */

final class PageBlockCollage extends Instance {
	public function request(array $items,object $caption) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x65a0fa4d);
		$writer->tgwriteVector($items,'PageBlock');
		$writer->write($caption->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['items'] = $reader->tgreadVector('PageBlock');
		$result['caption'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>