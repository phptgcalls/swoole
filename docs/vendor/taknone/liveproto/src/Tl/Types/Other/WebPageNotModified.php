<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int cached_page_views
 * @return WebPage
 */

final class WebPageNotModified extends Instance {
	public function request(? int $cached_page_views = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x7311ca11);
		$flags = 0;
		$flags |= is_null($cached_page_views) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		if(is_null($cached_page_views) === false):
			$writer->writeInt($cached_page_views);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['cached_page_views'] = $reader->readInt();
		else:
			$result['cached_page_views'] = null;
		endif;
		return new self($result);
	}
}

?>