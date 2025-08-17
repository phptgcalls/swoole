<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string url true spoiler int ttl_seconds inputphoto video_cover int video_timestamp
 * @return InputMedia
 */

final class InputMediaDocumentExternal extends Instance {
	public function request(string $url,? true $spoiler = null,? int $ttl_seconds = null,? object $video_cover = null,? int $video_timestamp = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x779600f9);
		$flags = 0;
		$flags |= is_null($spoiler) ? 0 : (1 << 1);
		$flags |= is_null($ttl_seconds) ? 0 : (1 << 0);
		$flags |= is_null($video_cover) ? 0 : (1 << 2);
		$flags |= is_null($video_timestamp) ? 0 : (1 << 3);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($url);
		if(is_null($ttl_seconds) === false):
			$writer->writeInt($ttl_seconds);
		endif;
		if(is_null($video_cover) === false):
			$writer->write($video_cover->read());
		endif;
		if(is_null($video_timestamp) === false):
			$writer->writeInt($video_timestamp);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 1)):
			$result['spoiler'] = true;
		else:
			$result['spoiler'] = false;
		endif;
		$result['url'] = $reader->tgreadBytes();
		if($flags & (1 << 0)):
			$result['ttl_seconds'] = $reader->readInt();
		else:
			$result['ttl_seconds'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['video_cover'] = $reader->tgreadObject();
		else:
			$result['video_cover'] = null;
		endif;
		if($flags & (1 << 3)):
			$result['video_timestamp'] = $reader->readInt();
		else:
			$result['video_timestamp'] = null;
		endif;
		return new self($result);
	}
}

?>