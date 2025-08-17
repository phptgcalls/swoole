<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<PageBlock> blocks richtext title true open
 * @return PageBlock
 */

final class PageBlockDetails extends Instance {
	public function request(array $blocks,object $title,? true $open = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x76768bed);
		$flags = 0;
		$flags |= is_null($open) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->tgwriteVector($blocks,'PageBlock');
		$writer->write($title->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['open'] = true;
		else:
			$result['open'] = false;
		endif;
		$result['blocks'] = $reader->tgreadVector('PageBlock');
		$result['title'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>