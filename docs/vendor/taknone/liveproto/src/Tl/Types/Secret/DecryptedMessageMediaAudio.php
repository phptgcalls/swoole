<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Secret;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int duration string mime_type int size bytes key bytes iv
 * @return secret.DecryptedMessageMedia
 */

final class DecryptedMessageMediaAudio extends Instance {
	public function request(int $duration,string $mime_type,int $size,string $key,string $iv) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x57e0a9cb);
		$writer->writeInt($duration);
		$writer->tgwriteBytes($mime_type);
		$writer->writeInt($size);
		$writer->tgwriteBytes($key);
		$writer->tgwriteBytes($iv);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['duration'] = $reader->readInt();
		$result['mime_type'] = $reader->tgreadBytes();
		$result['size'] = $reader->readInt();
		$result['key'] = $reader->tgreadBytes();
		$result['iv'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>