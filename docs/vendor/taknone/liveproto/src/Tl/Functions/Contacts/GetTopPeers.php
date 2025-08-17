<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Contacts;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int offset int limit long hash true correspondents true bots_pm true bots_inline true phone_calls true forward_users true forward_chats true groups true channels true bots_app
 * @return contacts.TopPeers
 */

final class GetTopPeers extends Instance {
	public function request(int $offset,int $limit,int $hash,? true $correspondents = null,? true $bots_pm = null,? true $bots_inline = null,? true $phone_calls = null,? true $forward_users = null,? true $forward_chats = null,? true $groups = null,? true $channels = null,? true $bots_app = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x973478b6);
		$flags = 0;
		$flags |= is_null($correspondents) ? 0 : (1 << 0);
		$flags |= is_null($bots_pm) ? 0 : (1 << 1);
		$flags |= is_null($bots_inline) ? 0 : (1 << 2);
		$flags |= is_null($phone_calls) ? 0 : (1 << 3);
		$flags |= is_null($forward_users) ? 0 : (1 << 4);
		$flags |= is_null($forward_chats) ? 0 : (1 << 5);
		$flags |= is_null($groups) ? 0 : (1 << 10);
		$flags |= is_null($channels) ? 0 : (1 << 15);
		$flags |= is_null($bots_app) ? 0 : (1 << 16);
		$writer->writeInt($flags);
		$writer->writeInt($offset);
		$writer->writeInt($limit);
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