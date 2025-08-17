<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<ChannelAdminLogEvent> events Vector<Chat> chats Vector<User> users
 * @return channels.AdminLogResults
 */

final class AdminLogResults extends Instance {
	public function request(array $events,array $chats,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xed8af74d);
		$writer->tgwriteVector($events,'ChannelAdminLogEvent');
		$writer->tgwriteVector($chats,'Chat');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['events'] = $reader->tgreadVector('ChannelAdminLogEvent');
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>