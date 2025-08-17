<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Stories;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long hash Vector<StoryAlbum> albums
 * @return stories.Albums
 */

final class Albums extends Instance {
	public function request(int $hash,array $albums) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc3987a3a);
		$writer->writeLong($hash);
		$writer->tgwriteVector($albums,'StoryAlbum');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['hash'] = $reader->readLong();
		$result['albums'] = $reader->tgreadVector('StoryAlbum');
		return new self($result);
	}
}

?>