<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param richtext author int published_date
 * @return PageBlock
 */

final class PageBlockAuthorDate extends Instance {
	public function request(object $author,int $published_date) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xbaafe5e0);
		$writer->write($author->read());
		$writer->writeInt($published_date);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['author'] = $reader->tgreadObject();
		$result['published_date'] = $reader->readInt();
		return new self($result);
	}
}

?>