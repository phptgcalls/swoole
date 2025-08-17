<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string emoticon long hash
 * @return messages.Stickers
 */

final class GetStickers extends Instance {
	public function request(string $emoticon,int $hash) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xd5a5d3a1);
		$writer->tgwriteBytes($emoticon);
		$writer->writeLong($hash);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>