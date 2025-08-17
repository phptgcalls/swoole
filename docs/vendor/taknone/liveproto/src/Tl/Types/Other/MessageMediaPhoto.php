<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param true spoiler photo photo int ttl_seconds
 * @return MessageMedia
 */

final class MessageMediaPhoto extends Instance {
	public function request(? true $spoiler = null,? object $photo = null,? int $ttl_seconds = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x695150d7);
		$flags = 0;
		$flags |= is_null($spoiler) ? 0 : (1 << 3);
		$flags |= is_null($photo) ? 0 : (1 << 0);
		$flags |= is_null($ttl_seconds) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		if(is_null($photo) === false):
			$writer->write($photo->read());
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
			$result['spoiler'] = true;
		else:
			$result['spoiler'] = false;
		endif;
		if($flags & (1 << 0)):
			$result['photo'] = $reader->tgreadObject();
		else:
			$result['photo'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['ttl_seconds'] = $reader->readInt();
		else:
			$result['ttl_seconds'] = null;
		endif;
		return new self($result);
	}
}

?>