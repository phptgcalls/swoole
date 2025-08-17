<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Phone;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int count Vector<GroupCallParticipant> participants string next_offset Vector<Chat> chats Vector<User> users int version
 * @return phone.GroupParticipants
 */

final class GroupParticipants extends Instance {
	public function request(int $count,array $participants,string $next_offset,array $chats,array $users,int $version) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf47751b6);
		$writer->writeInt($count);
		$writer->tgwriteVector($participants,'GroupCallParticipant');
		$writer->tgwriteBytes($next_offset);
		$writer->tgwriteVector($chats,'Chat');
		$writer->tgwriteVector($users,'User');
		$writer->writeInt($version);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['count'] = $reader->readInt();
		$result['participants'] = $reader->tgreadVector('GroupCallParticipant');
		$result['next_offset'] = $reader->tgreadBytes();
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		$result['version'] = $reader->readInt();
		return new self($result);
	}
}

?>