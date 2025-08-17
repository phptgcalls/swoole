<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Secret;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param bytes thumb int thumb_w int thumb_h string mime_type long size bytes key bytes iv Vector<DocumentAttribute> attributes string caption
 * @return secret.DecryptedMessageMedia
 */

final class DecryptedMessageMediaDocument extends Instance {
	public function request(string $thumb,int $thumb_w,int $thumb_h,string $mime_type,int $size,string $key,string $iv,array $attributes,string $caption) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x6abd9782);
		$writer->tgwriteBytes($thumb);
		$writer->writeInt($thumb_w);
		$writer->writeInt($thumb_h);
		$writer->tgwriteBytes($mime_type);
		$writer->writeLong($size);
		$writer->tgwriteBytes($key);
		$writer->tgwriteBytes($iv);
		$writer->tgwriteVector($attributes,'DocumentAttribute');
		$writer->tgwriteBytes($caption);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['thumb'] = $reader->tgreadBytes();
		$result['thumb_w'] = $reader->readInt();
		$result['thumb_h'] = $reader->readInt();
		$result['mime_type'] = $reader->tgreadBytes();
		$result['size'] = $reader->readLong();
		$result['key'] = $reader->tgreadBytes();
		$result['iv'] = $reader->tgreadBytes();
		$result['attributes'] = $reader->tgreadVector('DocumentAttribute');
		$result['caption'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>