<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Help;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<RecentMeUrl> urls Vector<Chat> chats Vector<User> users
 * @return help.RecentMeUrls
 */

final class RecentMeUrls extends Instance {
	public function request(array $urls,array $chats,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe0310d7);
		$writer->tgwriteVector($urls,'RecentMeUrl');
		$writer->tgwriteVector($chats,'Chat');
		$writer->tgwriteVector($users,'User');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['urls'] = $reader->tgreadVector('RecentMeUrl');
		$result['chats'] = $reader->tgreadVector('Chat');
		$result['users'] = $reader->tgreadVector('User');
		return new self($result);
	}
}

?>