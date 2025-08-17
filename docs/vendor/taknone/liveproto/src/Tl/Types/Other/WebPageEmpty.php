<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long id string url
 * @return WebPage
 */

final class WebPageEmpty extends Instance {
	public function request(int $id,? string $url = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x211a1788);
		$flags = 0;
		$flags |= is_null($url) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeLong($id);
		if(is_null($url) === false):
			$writer->tgwriteBytes($url);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['id'] = $reader->readLong();
		if($flags & (1 << 0)):
			$result['url'] = $reader->tgreadBytes();
		else:
			$result['url'] = null;
		endif;
		return new self($result);
	}
}

?>