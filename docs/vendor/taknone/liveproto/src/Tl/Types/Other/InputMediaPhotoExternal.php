<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string url true spoiler int ttl_seconds
 * @return InputMedia
 */

final class InputMediaPhotoExternal extends Instance {
	public function request(string $url,? true $spoiler = null,? int $ttl_seconds = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe5bbfe1a);
		$flags = 0;
		$flags |= is_null($spoiler) ? 0 : (1 << 1);
		$flags |= is_null($ttl_seconds) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($url);
		if(is_null($ttl_seconds) === false):
			$writer->writeInt($ttl_seconds);
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
		return new self($result);
	}
}

?>