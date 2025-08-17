<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param bytes random_id true media true fullscreen
 * @return Bool
 */

final class ClickSponsoredMessage extends Instance {
	public function request(string $random_id,? true $media = null,? true $fullscreen = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8235057e);
		$flags = 0;
		$flags |= is_null($media) ? 0 : (1 << 0);
		$flags |= is_null($fullscreen) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($random_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>