<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int folder_id
 * @return messages.PeerDialogs
 */

final class GetPinnedDialogs extends Instance {
	public function request(int $folder_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xd6b94df2);
		$writer->writeInt($folder_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>