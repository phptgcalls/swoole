<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Phone;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param groupcall call Vector<GroupCallParticipant> participants string participants_next_offset Vector<Chat> chats Vector<User> users
 * @return phone.GroupCall
 */

final class GroupCall extends Instance {
	public function request(object $call,array $participants,string $participants_next_offset,array $chats,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x9e727aad);
		$writer->write($call->read());
		$writer->tgwriteVector($participants,'GroupCallParticipant');
		$writer->tgwriteBytes($participants_next_offset);
		$writer->tgwriteVector($chats,'Chat');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['call'] = $reader->tgreadObject();
		$result['participants'] = $reader->tgreadVector('GroupCallParticipant');
		$result['participants_next_offset'] = $reader->tgreadBytes();
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>