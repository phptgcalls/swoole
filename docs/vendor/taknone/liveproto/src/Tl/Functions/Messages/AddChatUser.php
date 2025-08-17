<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long chat_id inputuser user_id int fwd_limit
 * @return messages.InvitedUsers
 */

final class AddChatUser extends Instance {
	public function request(int $chat_id,object $user_id,int $fwd_limit) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xcbc6d107);
		$writer->writeLong($chat_id);
		$writer->write($user_id->read());
		$writer->writeInt($fwd_limit);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>