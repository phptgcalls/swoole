<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param webpage webpage true force_large_media true force_small_media true manual true safe
 * @return MessageMedia
 */

final class MessageMediaWebPage extends Instance {
	public function request(object $webpage,? true $force_large_media = null,? true $force_small_media = null,? true $manual = null,? true $safe = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xddf10c3b);
		$flags = 0;
		$flags |= is_null($force_large_media) ? 0 : (1 << 0);
		$flags |= is_null($force_small_media) ? 0 : (1 << 1);
		$flags |= is_null($manual) ? 0 : (1 << 3);
		$flags |= is_null($safe) ? 0 : (1 << 4);
		$writer->writeInt($flags);
		$writer->write($webpage->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['force_large_media'] = true;
		else:
			$result['force_large_media'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['force_small_media'] = true;
		else:
			$result['force_small_media'] = false;
		endif;
		if($flags & (1 << 3)):
			$result['manual'] = true;
		else:
			$result['manual'] = false;
		endif;
		if($flags & (1 << 4)):
			$result['safe'] = true;
		else:
			$result['safe'] = false;
		endif;
		$result['webpage'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>