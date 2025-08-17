<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int album_id string title photo icon_photo document icon_video
 * @return StoryAlbum
 */

final class StoryAlbum extends Instance {
	public function request(int $album_id,string $title,? object $icon_photo = null,? object $icon_video = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x9325705a);
		$flags = 0;
		$flags |= is_null($icon_photo) ? 0 : (1 << 0);
		$flags |= is_null($icon_video) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->writeInt($album_id);
		$writer->tgwriteBytes($title);
		if(is_null($icon_photo) === false):
			$writer->write($icon_photo->read());
		endif;
		if(is_null($icon_video) === false):
			$writer->write($icon_video->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['album_id'] = $reader->readInt();
		$result['title'] = $reader->tgreadBytes();
		if($flags & (1 << 0)):
			$result['icon_photo'] = $reader->tgreadObject();
		else:
			$result['icon_photo'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['icon_video'] = $reader->tgreadObject();
		else:
			$result['icon_video'] = null;
		endif;
		return new self($result);
	}
}

?>