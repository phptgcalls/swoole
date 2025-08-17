<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int offset_date inputuser offset_user int limit true requested true subscription_expired string link string q
 * @return messages.ChatInviteImporters
 */

final class GetChatInviteImporters extends Instance {
	public function request(object $peer,int $offset_date,object $offset_user,int $limit,? true $requested = null,? true $subscription_expired = null,? string $link = null,? string $q = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xdf04dd4e);
		$flags = 0;
		$flags |= is_null($requested) ? 0 : (1 << 0);
		$flags |= is_null($subscription_expired) ? 0 : (1 << 3);
		$flags |= is_null($link) ? 0 : (1 << 1);
		$flags |= is_null($q) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		if(is_null($link) === false):
			$writer->tgwriteBytes($link);
		endif;
		if(is_null($q) === false):
			$writer->tgwriteBytes($q);
		endif;
		$writer->writeInt($offset_date);
		$writer->write($offset_user->read());
		$writer->writeInt($limit);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>