<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int shortcut_id long hash Vector<int> id
 * @return messages.Messages
 */

final class GetQuickReplyMessages extends Instance {
	public function request(int $shortcut_id,int $hash,? array $id = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x94a495c3);
		$flags = 0;
		$flags |= is_null($id) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeInt($shortcut_id);
		if(is_null($id) === false):
			$writer->tgwriteVector($id,'int');
		endif;
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