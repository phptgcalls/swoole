<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param true contacts true message_users true message_chats true message_megagroups true message_channels true files long file_max_size
 * @return account.Takeout
 */

final class InitTakeoutSession extends Instance {
	public function request(? true $contacts = null,? true $message_users = null,? true $message_chats = null,? true $message_megagroups = null,? true $message_channels = null,? true $files = null,? int $file_max_size = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8ef3eab0);
		$flags = 0;
		$flags |= is_null($contacts) ? 0 : (1 << 0);
		$flags |= is_null($message_users) ? 0 : (1 << 1);
		$flags |= is_null($message_chats) ? 0 : (1 << 2);
		$flags |= is_null($message_megagroups) ? 0 : (1 << 3);
		$flags |= is_null($message_channels) ? 0 : (1 << 4);
		$flags |= is_null($files) ? 0 : (1 << 5);
		$flags |= is_null($file_max_size) ? 0 : (1 << 5);
		$writer->writeInt($flags);
		if(is_null($file_max_size) === false):
			$writer->writeLong($file_max_size);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>