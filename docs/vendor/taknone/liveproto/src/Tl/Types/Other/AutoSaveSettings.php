<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param true photos true videos long video_max_size
 * @return AutoSaveSettings
 */

final class AutoSaveSettings extends Instance {
	public function request(? true $photos = null,? true $videos = null,? int $video_max_size = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc84834ce);
		$flags = 0;
		$flags |= is_null($photos) ? 0 : (1 << 0);
		$flags |= is_null($videos) ? 0 : (1 << 1);
		$flags |= is_null($video_max_size) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		if(is_null($video_max_size) === false):
			$writer->writeLong($video_max_size);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['photos'] = true;
		else:
			$result['photos'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['videos'] = true;
		else:
			$result['videos'] = false;
		endif;
		if($flags & (1 << 2)):
			$result['video_max_size'] = $reader->readLong();
		else:
			$result['video_max_size'] = null;
		endif;
		return new self($result);
	}
}

?>