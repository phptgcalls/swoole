<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputchannel channel Vector<InputUser> users
 * @return messages.InvitedUsers
 */

final class InviteToChannel extends Instance {
	public function request(object $channel,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc9e33d54);
		$writer->write($channel->read());
		$writer->tgwriteVector($users,'InputUser');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>