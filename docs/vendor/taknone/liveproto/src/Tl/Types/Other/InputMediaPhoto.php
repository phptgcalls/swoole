<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputphoto id true spoiler int ttl_seconds
 * @return InputMedia
 */

final class InputMediaPhoto extends Instance {
	public function request(object $id,? true $spoiler = null,? int $ttl_seconds = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb3ba0635);
		$flags = 0;
		$flags |= is_null($spoiler) ? 0 : (1 << 1);
		$flags |= is_null($ttl_seconds) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($id->read());
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
		$result['id'] = $reader->tgreadObject();
		if($flags & (1 << 0)):
			$result['ttl_seconds'] = $reader->readInt();
		else:
			$result['ttl_seconds'] = null;
		endif;
		return new self($result);
	}
}

?>