<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputfile file string mime_type Vector<DocumentAttribute> attributes true nosound_video true force_file true spoiler inputfile thumb Vector<InputDocument> stickers inputphoto video_cover int video_timestamp int ttl_seconds
 * @return InputMedia
 */

final class InputMediaUploadedDocument extends Instance {
	public function request(object $file,string $mime_type,array $attributes,? true $nosound_video = null,? true $force_file = null,? true $spoiler = null,? object $thumb = null,? array $stickers = null,? object $video_cover = null,? int $video_timestamp = null,? int $ttl_seconds = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x37c9330);
		$flags = 0;
		$flags |= is_null($nosound_video) ? 0 : (1 << 3);
		$flags |= is_null($force_file) ? 0 : (1 << 4);
		$flags |= is_null($spoiler) ? 0 : (1 << 5);
		$flags |= is_null($thumb) ? 0 : (1 << 2);
		$flags |= is_null($stickers) ? 0 : (1 << 0);
		$flags |= is_null($video_cover) ? 0 : (1 << 6);
		$flags |= is_null($video_timestamp) ? 0 : (1 << 7);
		$flags |= is_null($ttl_seconds) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->write($file->read());
		if(is_null($thumb) === false):
			$writer->write($thumb->read());
		endif;
		$writer->tgwriteBytes($mime_type);
		$writer->tgwriteVector($attributes,'DocumentAttribute');
		if(is_null($stickers) === false):
			$writer->tgwriteVector($stickers,'InputDocument');
		endif;
		if(is_null($video_cover) === false):
			$writer->write($video_cover->read());
		endif;
		if(is_null($video_timestamp) === false):
			$writer->writeInt($video_timestamp);
		endif;
		if(is_null($ttl_seconds) === false):
			$writer->writeInt($ttl_seconds);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 3)):
			$result['nosound_video'] = true;
		else:
			$result['nosound_video'] = false;
		endif;
		if($flags & (1 << 4)):
			$result['force_file'] = true;
		else:
			$result['force_file'] = false;
		endif;
		if($flags & (1 << 5)):
			$result['spoiler'] = true;
		else:
			$result['spoiler'] = false;
		endif;
		$result['file'] = $reader->tgreadObject();
		if($flags & (1 << 2)):
			$result['thumb'] = $reader->tgreadObject();
		else:
			$result['thumb'] = null;
		endif;
		$result['mime_type'] = $reader->tgreadBytes();
		$result['attributes'] = $reader->tgreadVector('DocumentAttribute');
		if($flags & (1 << 0)):
			$result['stickers'] = $reader->tgreadVector('InputDocument');
		else:
			$result['stickers'] = null;
		endif;
		if($flags & (1 << 6)):
			$result['video_cover'] = $reader->tgreadObject();
		else:
			$result['video_cover'] = null;
		endif;
		if($flags & (1 << 7)):
			$result['video_timestamp'] = $reader->readInt();
		else:
			$result['video_timestamp'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['ttl_seconds'] = $reader->readInt();
		else:
			$result['ttl_seconds'] = null;
		endif;
		return new self($result);
	}
}

?>