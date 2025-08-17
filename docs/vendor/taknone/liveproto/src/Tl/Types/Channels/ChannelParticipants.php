<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int count Vector<ChannelParticipant> participants Vector<Chat> chats Vector<User> users
 * @return channels.ChannelParticipants
 */

final class ChannelParticipants extends Instance {
	public function request(int $count,array $participants,array $chats,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x9ab0feaf);
		$writer->writeInt($count);
		$writer->tgwriteVector($participants,'ChannelParticipant');
		$writer->tgwriteVector($chats,'Chat');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['count'] = $reader->readInt();
		$result['participants'] = $reader->tgreadVector('ChannelParticipant');
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>