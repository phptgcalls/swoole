<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<InputUser> users string title int ttl_period
 * @return messages.InvitedUsers
 */

final class CreateChat extends Instance {
	public function request(array $users,string $title,? int $ttl_period = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x92ceddd4);
		$flags = 0;
		$flags |= is_null($ttl_period) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->tgwriteVector($users,'InputUser');
		$writer->tgwriteBytes($title);
		if(is_null($ttl_period) === false):
			$writer->writeInt($ttl_period);
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