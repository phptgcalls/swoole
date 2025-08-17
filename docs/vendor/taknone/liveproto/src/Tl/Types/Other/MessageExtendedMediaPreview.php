<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int w int h photosize thumb int video_duration
 * @return MessageExtendedMedia
 */

final class MessageExtendedMediaPreview extends Instance {
	public function request(? int $w = null,? int $h = null,? object $thumb = null,? int $video_duration = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xad628cc8);
		$flags = 0;
		$flags |= is_null($w) ? 0 : (1 << 0);
		$flags |= is_null($h) ? 0 : (1 << 0);
		$flags |= is_null($thumb) ? 0 : (1 << 1);
		$flags |= is_null($video_duration) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		if(is_null($w) === false):
			$writer->writeInt($w);
		endif;
		if(is_null($h) === false):
			$writer->writeInt($h);
		endif;
		if(is_null($thumb) === false):
			$writer->write($thumb->read());
		endif;
		if(is_null($video_duration) === false):
			$writer->writeInt($video_duration);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['w'] = $reader->readInt();
		else:
			$result['w'] = null;
		endif;
		if($flags & (1 << 0)):
			$result['h'] = $reader->readInt();
		else:
			$result['h'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['thumb'] = $reader->tgreadObject();
		else:
			$result['thumb'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['video_duration'] = $reader->readInt();
		else:
			$result['video_duration'] = null;
		endif;
		return new self($result);
	}
}

?>