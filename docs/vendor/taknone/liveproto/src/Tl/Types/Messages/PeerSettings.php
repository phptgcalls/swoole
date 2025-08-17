<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param peersettings settings Vector<Chat> chats Vector<User> users
 * @return messages.PeerSettings
 */

final class PeerSettings extends Instance {
	public function request(object $settings,array $chats,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x6880b94d);
		$writer->write($settings->read());
		$writer->tgwriteVector($chats,'Chat');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['settings'] = $reader->tgreadObject();
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>