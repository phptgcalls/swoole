<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long chat_id inputuser user_id bool is_admin
 * @return Bool
 */

final class EditChatAdmin extends Instance {
	public function request(int $chat_id,object $user_id,bool $is_admin) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa85bd1c2);
		$writer->writeLong($chat_id);
		$writer->write($user_id->read());
		$writer->tgwriteBool($is_admin);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>