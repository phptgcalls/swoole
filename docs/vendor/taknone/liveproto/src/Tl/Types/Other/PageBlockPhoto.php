<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long photo_id pagecaption caption string url long webpage_id
 * @return PageBlock
 */

final class PageBlockPhoto extends Instance {
	public function request(int $photo_id,object $caption,? string $url = null,? int $webpage_id = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x1759c560);
		$flags = 0;
		$flags |= is_null($url) ? 0 : (1 << 0);
		$flags |= is_null($webpage_id) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeLong($photo_id);
		$writer->write($caption->read());
		if(is_null($url) === false):
			$writer->tgwriteBytes($url);
		endif;
		if(is_null($webpage_id) === false):
			$writer->writeLong($webpage_id);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['photo_id'] = $reader->readLong();
		$result['caption'] = $reader->tgreadObject();
		if($flags & (1 << 0)):
			$result['url'] = $reader->tgreadBytes();
		else:
			$result['url'] = null;
		endif;
		if($flags & (1 << 0)):
			$result['webpage_id'] = $reader->readLong();
		else:
			$result['webpage_id'] = null;
		endif;
		return new self($result);
	}
}

?>