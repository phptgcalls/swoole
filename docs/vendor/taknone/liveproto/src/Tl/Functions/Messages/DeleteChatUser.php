<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long chat_id inputuser user_id true revoke_history
 * @return Updates
 */

final class DeleteChatUser extends Instance {
	public function request(int $chat_id,object $user_id,? true $revoke_history = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa2185cab);
		$flags = 0;
		$flags |= is_null($revoke_history) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeLong($chat_id);
		$writer->write($user_id->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>