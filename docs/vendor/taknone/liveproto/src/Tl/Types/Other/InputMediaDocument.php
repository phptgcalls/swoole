<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputdocument id true spoiler inputphoto video_cover int video_timestamp int ttl_seconds string query
 * @return InputMedia
 */

final class InputMediaDocument extends Instance {
	public function request(object $id,? true $spoiler = null,? object $video_cover = null,? int $video_timestamp = null,? int $ttl_seconds = null,? string $query = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa8763ab5);
		$flags = 0;
		$flags |= is_null($spoiler) ? 0 : (1 << 2);
		$flags |= is_null($video_cover) ? 0 : (1 << 3);
		$flags |= is_null($video_timestamp) ? 0 : (1 << 4);
		$flags |= is_null($ttl_seconds) ? 0 : (1 << 0);
		$flags |= is_null($query) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->write($id->read());
		if(is_null($video_cover) === false):
			$writer->write($video_cover->read());
		endif;
		if(is_null($video_timestamp) === false):
			$writer->writeInt($video_timestamp);
		endif;
		if(is_null($ttl_seconds) === false):
			$writer->writeInt($ttl_seconds);
		endif;
		if(is_null($query) === false):
			$writer->tgwriteBytes($query);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 2)):
			$result['spoiler'] = true;
		else:
			$result['spoiler'] = false;
		endif;
		$result['id'] = $reader->tgreadObject();
		if($flags & (1 << 3)):
			$result['video_cover'] = $reader->tgreadObject();
		else:
			$result['video_cover'] = null;
		endif;
		if($flags & (1 << 4)):
			$result['video_timestamp'] = $reader->readInt();
		else:
			$result['video_timestamp'] = null;
		endif;
		if($flags & (1 << 0)):
			$result['ttl_seconds'] = $reader->readInt();
		else:
			$result['ttl_seconds'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['query'] = $reader->tgreadBytes();
		else:
			$result['query'] = null;
		endif;
		return new self($result);
	}
}

?>