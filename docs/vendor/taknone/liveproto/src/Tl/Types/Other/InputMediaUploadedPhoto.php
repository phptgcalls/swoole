<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputfile file true spoiler Vector<InputDocument> stickers int ttl_seconds
 * @return InputMedia
 */

final class InputMediaUploadedPhoto extends Instance {
	public function request(object $file,? true $spoiler = null,? array $stickers = null,? int $ttl_seconds = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x1e287d04);
		$flags = 0;
		$flags |= is_null($spoiler) ? 0 : (1 << 2);
		$flags |= is_null($stickers) ? 0 : (1 << 0);
		$flags |= is_null($ttl_seconds) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->write($file->read());
		if(is_null($stickers) === false):
			$writer->tgwriteVector($stickers,'InputDocument');
		endif;
		if(is_null($ttl_seconds) === false):
			$writer->writeInt($ttl_seconds);
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
		$result['file'] = $reader->tgreadObject();
		if($flags & (1 << 0)):
			$result['stickers'] = $reader->tgreadVector('InputDocument');
		else:
			$result['stickers'] = null;
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