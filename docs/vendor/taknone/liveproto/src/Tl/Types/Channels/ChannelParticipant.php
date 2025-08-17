<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param channelparticipant participant Vector<Chat> chats Vector<User> users
 * @return channels.ChannelParticipant
 */

final class ChannelParticipant extends Instance {
	public function request(object $participant,array $chats,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xdfb80317);
		$writer->write($participant->read());
		$writer->tgwriteVector($chats,'Chat');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['participant'] = $reader->tgreadObject();
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>