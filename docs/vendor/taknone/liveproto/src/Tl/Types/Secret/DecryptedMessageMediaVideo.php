<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Secret;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param bytes thumb int thumb_w int thumb_h int duration string mime_type int w int h int size bytes key bytes iv string caption
 * @return secret.DecryptedMessageMedia
 */

final class DecryptedMessageMediaVideo extends Instance {
	public function request(string $thumb,int $thumb_w,int $thumb_h,int $duration,string $mime_type,int $w,int $h,int $size,string $key,string $iv,string $caption) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x970c8c0e);
		$writer->tgwriteBytes($thumb);
		$writer->writeInt($thumb_w);
		$writer->writeInt($thumb_h);
		$writer->writeInt($duration);
		$writer->tgwriteBytes($mime_type);
		$writer->writeInt($w);
		$writer->writeInt($h);
		$writer->writeInt($size);
		$writer->tgwriteBytes($key);
		$writer->tgwriteBytes($iv);
		$writer->tgwriteBytes($caption);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['thumb'] = $reader->tgreadBytes();
		$result['thumb_w'] = $reader->readInt();
		$result['thumb_h'] = $reader->readInt();
		$result['duration'] = $reader->readInt();
		$result['mime_type'] = $reader->tgreadBytes();
		$result['w'] = $reader->readInt();
		$result['h'] = $reader->readInt();
		$result['size'] = $reader->readInt();
		$result['key'] = $reader->tgreadBytes();
		$result['iv'] = $reader->tgreadBytes();
		$result['caption'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>